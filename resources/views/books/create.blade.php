@extends('layouts.layout')

@section('content')

<h3>Add New Book</h3>

<form method="POST" action="{{ route('books.store') }}">
    @csrf

    <label>Book Title:</label>
    <input type="text" name="title" required>

    <label>Author:</label>
    <input type="text" name="author" required>

    <label>Category:</label>
    <select name="category_id" required>
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <label>Description:</label>
    <textarea name="description"></textarea>

    <button type="submit">Save Book</button>
</form>

@endsection
