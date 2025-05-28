<!-- resources/views/teachers/edit.blade.php -->

@extends('layout')

@section('content')
    <h2>Edit teacher</h2>

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $teacher->name }}" required>
        <br>
        
        <button type="submit">Update</button>
    </form>
@endsection
