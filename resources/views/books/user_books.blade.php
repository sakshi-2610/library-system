@extends('layouts.layout')

@section('content')

<h2>Available Books</h2>

<table border="1" cellpadding="10" width="100%">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($books as $book)
    <tr>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ ucfirst($book->status) }}</td>
        <td>
            @if($book->status === 'available')
                <a href="{{ route('user.books.borrow', $book->id) }}" class="btn btn-primary">Borrow</a>
            @elseif(in_array($book->id, $userBorrowedBooks))
                <a href="{{ route('user.books.return', $book->id) }}" class="btn btn-warning">Return</a>
            @else
                Borrowed by someone else
            @endif
        </td>
    </tr>
    @endforeach
</table>

@endsection
