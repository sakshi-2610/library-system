@extends('layouts.layout')

@section('content')

<h3>All Categories</h3>

<a href="/categories/create" class="btn btn-primary">Add New Category</a>

<table>
    <tr>
        <th>ID</th>
        <th>Category Name</th>
        <th>Created At</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->created_at->format('Y-m-d') }}</td>
    </tr>
    @endforeach

</table>

@endsection
