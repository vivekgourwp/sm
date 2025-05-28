<h2>Enroll Student in Course</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('enrollments.store') }}" method="POST">
    @csrf

    <label for="student_id">Student:</label>
    <select name="student_id" required>
        @foreach ($students as $student)
            <option value="{{ $student->id }}">{{ $student->name }}</option>
        @endforeach
    </select>

    <br><br>

    <label for="course_id">Course:</label>
    <select name="course_id" required>
        @foreach ($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">Enroll</button>
</form>
