<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\DashboardController;

/* Web Routes */


// HOME ROUTE

Route::get('/', function () {
    // If user is logged in, redirect to respective dashboard
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('dashboard')
            : redirect()->route('user.dashboard');
    }
    // Otherwise go to login
    return redirect()->route('login');
});


// AUTH ROUTES (Login & Register)

Route::middleware('guest')->group(function () {
    // Login page (Breeze handles POST login)
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // Registration page
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// Breeze Auth Routes (handles POST for login, register, password reset, etc.)
require __DIR__.'/auth.php';


// DASHBOARD ROUTES

Route::middleware(['auth'])->group(function () {

    // Admin Dashboard (only admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('is_admin')
        ->name('dashboard');

    // User Dashboard
    Route::get('/user-dashboard', [DashboardController::class, 'userDashboard'])
        ->name('user.dashboard');
});


// ADMIN ONLY ROUTES
Route::middleware(['auth', 'is_admin'])->group(function () {

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    // Books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');

    // Admin Borrow/Return
    Route::get('/books/{book}/borrow', [BorrowController::class, 'borrow'])->name('admin.books.borrow');
    Route::get('/books/{book}/return', [BorrowController::class, 'return'])->name('admin.books.return');
});


// USER ROUTES

Route::middleware(['auth'])->group(function () {

    // View all books with user's borrowed books info
    Route::get('/user/books', function () {
        $books = \App\Models\Book::all();

        // IDs of books currently borrowed by this user
        $userBorrowedBooks = \App\Models\BorrowedBook::where('user_id', auth()->id())
            ->where('status', 'borrowed')
            ->pluck('book_id')
            ->toArray();

        return view('books.user_books', compact('books', 'userBorrowedBooks'));
    })->name('user.books');

    // Borrow & Return books
    Route::get('/user/books/{book}/borrow', [BorrowController::class, 'borrow'])
        ->name('user.books.borrow');

    Route::get('/user/books/{book}/return', [BorrowController::class, 'return'])
        ->name('user.books.return');
});
