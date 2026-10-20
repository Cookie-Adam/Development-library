<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Client;
use App\Models\Computer;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'totalBooks' => Book::count(),
            'borrowedNow' => Borrowing::active()->count(),
            'overdue' => Borrowing::overdue()->count(),
            'computersInUse' => Computer::where('status', 'in_use')->count(),
            'clients' => Client::count(),
        ]);
    }
}
