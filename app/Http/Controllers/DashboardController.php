<?php

namespace App\Http\Controllers;

use App\Models\BorrowedBook;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     * Shows ALL borrowed records
     */
    public function index()
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('user.dashboard');
        }

        $borrowedRecords = BorrowedBook::with(['user', 'book'])
            ->orderBy('id', 'desc')
            ->get();

        return view('dashboard', compact('borrowedRecords'));
    }

    /**
     * User Dashboard
     * Shows ONLY this user's borrowed books
     */
    public function userDashboard()
    {
        $borrowedRecords = BorrowedBook::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('user_dashboard', compact('borrowedRecords'));
    }
}
