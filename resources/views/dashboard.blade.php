@extends('layouts.layout')

@section('content')

<h3>Welcome, {{ auth()->user()->name }}!</h3>
<p>Your Role: <strong>{{ auth()->user()->role }}</strong></p>

<hr>

<h4>Borrowed Records (All Users)</h4>

@if($borrowedRecords->count() > 0)
<table>
    <tr>
        <th>User</th>
        <th>Book</th>
        <th>Status</th>
        <th>Borrow Date</th>
        <th>Return Date</th>
    </tr>
    @foreach($borrowedRecords as $record)
    <tr>
        <td>{{ $record->user->name }}</td>
        <td>{{ $record->book->title }}</td>
        <td>{{ ucfirst($record->status) }}</td>
        <td>{{ $record->borrow_date }}</td>
        <td>{{ $record->return_date ?? '-' }}</td>
    </tr>
    @endforeach
</table>
@else
<p>No borrowed records found.</p>
@endif

@endsection
