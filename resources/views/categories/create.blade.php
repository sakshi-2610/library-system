@extends('layouts.layout')

@section('content')

<h3>Add New Category</h3>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf

    <label>Category Name:</label>
    <input type="text" name="name" required>

    <button type="submit">Save Category</button>
</form>

@endsection
