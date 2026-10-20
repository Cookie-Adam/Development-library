<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Client;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index()
    {
        // Active loans first, then most recent
        $borrowings = Borrowing::with(['client', 'book', 'staff'])
            ->orderByRaw('returned_at is not null')
            ->orderBy('due_at')
            ->paginate(15);

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        return view('borrowings.create', [
            'clients' => Client::orderBy('name')->get(),
            'books' => Book::where('available_copies', '>', 0)->orderBy('title')->get(),
            'staff' => Staff::orderBy('name')->get(),
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->validated();

        $error = DB::transaction(function () use ($data) {
            // Lock the row so two checkouts can't take the last copy
            $book = Book::lockForUpdate()->findOrFail($data['book_id']);

            if ($book->available_copies < 1) {
                return 'No copies of this book are available.';
            }

            Borrowing::create($data + ['borrowed_at' => today()]);
            $book->decrement('available_copies');

            return null;
        });

        if ($error) {
            return back()->withInput()->withErrors(['book_id' => $error]);
        }

        return redirect()->route('borrowings.index')->with('status', 'Book checked out.');
    }

    public function return(Borrowing $borrowing)
    {
        $returned = DB::transaction(function () use ($borrowing) {
            $borrowing = Borrowing::lockForUpdate()->find($borrowing->id);

            if ($borrowing->returned_at) {
                return false;
            }

            $borrowing->update(['returned_at' => today()]);
            $borrowing->book()->increment('available_copies');

            return true;
        });

        return redirect()->route('borrowings.index')->with(
            $returned ? 'status' : 'error',
            $returned ? 'Book returned.' : 'This book was already returned.'
        );
    }
}
