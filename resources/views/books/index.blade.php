@extends('layouts.layout')

@section('content')

<h3>All Books</h3>

<a href="/books/create" class="btn btn-primary">Add New Book</a>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Status</th>
        <!-- <th>Actions</th> -->
    </tr>

    @foreach($books as $book)
    <tr>
        <td>{{ $book->id }}</td>
        <td>{{ $book->title }}</td>
        <td>{{ $book->author }}</td>
        <td>{{ $book->category->name }}</td>
        <td>{{ $book->status }}</td>

        <!-- <td>
            @if($book->status === 'available')
                <a href="#" class="btn btn-success">Borrow</a>
            @else
                <a href="#" class="btn btn-warning">Return</a>
            @endif
        </td> -->
    </tr>
    @endforeach

</table>

@endsection
