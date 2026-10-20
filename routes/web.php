<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ComputerSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('clients', ClientController::class);
Route::resource('books', BookController::class);
Route::resource('computers', ComputerController::class);
Route::resource('staff', StaffController::class)->parameters(['staff' => 'staff']);

// Library logic
Route::resource('borrowings', BorrowingController::class)->only(['index', 'create', 'store']);
Route::patch('borrowings/{borrowing}/return', [BorrowingController::class, 'return'])->name('borrowings.return');

Route::resource('sessions', ComputerSessionController::class)->only(['index', 'create', 'store']);
Route::patch('sessions/{session}/end', [ComputerSessionController::class, 'end'])->name('sessions.end');
