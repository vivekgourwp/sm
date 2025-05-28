<!DOCTYPE html>
<html>
<head>
    <title>Courses List</title>
</head>
<body>
    <h1>Courses</h1>

    @if($courses->isEmpty())
        <p>No course found.</p>
    @else
        <ul>
            @foreach ($courses as $course)
                <li>
                    {{ $course->name }} 
                    (Teacher: {{ $course->teacher->name ?? 'N/A' }})
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
