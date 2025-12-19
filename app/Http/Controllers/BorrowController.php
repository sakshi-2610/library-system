<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BorrowedBook;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function borrow(Book $book)
    {
        // Check if book is available
        if ($book->status === 'borrowed') {
            return back()->with('error', 'Book is already borrowed.');
        }

        BorrowedBook::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'status' => 'borrowed'
        ]);

        $book->update(['status' => 'borrowed']);

        return back()->with('success', 'Book borrowed successfully.');
    }

    public function return(Book $book)
    {
        // Find the borrow record for this user
        $borrow = BorrowedBook::where('book_id', $book->id)
            ->where('user_id', Auth::id())
            ->where('status', 'borrowed')
            ->first();

        if (!$borrow) {
            return back()->with('error', 'You have not borrowed this book.');
        }

        $borrow->update([
            'return_date' => now(),
            'status' => 'returned'
        ]);

        $book->update(['status' => 'available']);

        return back()->with('success', 'Book returned successfully.');
    }
}
