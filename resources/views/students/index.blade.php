<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
</head>
<body>
    <h1>Students</h1>

    @if($students->isEmpty())
        <p>No students found.</p>
    @else
        <ul>
            @foreach ($students as $student)
                <li>{{ $student->name }} (Email: {{ $student->email }})</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
