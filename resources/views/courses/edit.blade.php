<!-- resources/views/students/edit.blade.php -->

@extends('layout')

@section('content')
    <h2>Edit Student</h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $student->name }}" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="{{ $student->email }}" required>
        <br>
        <button type="submit">Update</button>
    </form>
@endsection
