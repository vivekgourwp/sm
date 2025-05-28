<h2>Enrolled Students</h2>

@if($enrollments->isEmpty())
    <p>No enrollments found.</p>
@else
    <ul>
        @foreach ($enrollments as $enrollment)
            <li>
                {{ $enrollment->student->name }} is enrolled in {{ $enrollment->course->name }}
            </li>
        @endforeach
    </ul>
@endif
