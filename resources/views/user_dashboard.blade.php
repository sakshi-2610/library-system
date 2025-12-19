@extends('layouts.layout')

@section('content')
<h2>Welcome, {{ auth()->user()->name }}!</h2>
<p>Your Role: <strong>{{ ucfirst(auth()->user()->role) }}</strong></p>

<hr>

<h3>Your Borrowed Books</h3>

@if($borrowedRecords->count() > 0)
    <table border="1" cellpadding="10" width="100%">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Status</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>Action</th>
        </tr>

        @foreach($borrowedRecords as $record)
        <tr>
            <td>{{ $record->book->title }}</td>
            <td>{{ $record->book->author }}</td>
            <td>{{ ucfirst($record->status) }}</td>
            <td>{{ $record->borrow_date->format('d M Y') }}</td>
            <td>
                @if($record->return_date)
                    {{ $record->return_date->format('d M Y') }}
                @else
                    -
                @endif
            </td>
            <td>
                @if($record->status === 'borrowed')
                    <a href="{{ route('user.books.return', $record->book->id) }}" class="btn btn-warning">Return</a>
                @else
                    Returned
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@else
    <p>You have not borrowed any books yet.</p>
@endif

@endsection
