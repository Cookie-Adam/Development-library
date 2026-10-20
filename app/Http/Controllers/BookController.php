<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->trim();

        $books = Book::query()
            ->when($q->isNotEmpty(), fn ($query) => $query->where(fn ($w) => $w
                ->where('title', 'like', "%{$q}%")
                ->orWhere('author', 'like', "%{$q}%")
                ->orWhere('isbn', 'like', "%{$q}%")
                ->orWhere('category', 'like', "%{$q}%")))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(BookRequest $request)
    {
        $data = $request->validated();
        $data['available_copies'] = $data['copies']; // new books start fully available

        $book = Book::create($data);

        return redirect()->route('books.show', $book)->with('status', 'Book created.');
    }

    public function show(Book $book)
    {
        $book->load('borrowings.client');

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $data = $request->validated();
        $data['available_copies'] ??= $book->available_copies;

        $book->update($data);

        return redirect()->route('books.show', $book)->with('status', 'Book updated.');
    }

    public function destroy(Book $book)
    {
        if ($book->borrowings()->active()->exists()) {
            return back()->with('error', 'This book is currently borrowed.');
        }

        $book->delete();

        return redirect()->route('books.index')->with('status', 'Book deleted.');
    }
}
