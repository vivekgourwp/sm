<!DOCTYPE html>
<html>
<head>
    <title>teacher List</title>
</head>
<body>
    <h1>teachers</h1>

    @if($teachers->isEmpty())
        <p>No teachers found.</p>
    @else
        <ul>
            @foreach ($teachers as $teacher)
                <li>{{ $teacher->name }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
