<!-- resources/views/Courses/create.blade.php -->

<h2>Add Course</h2>

<form action="{{ route('courses.store') }}" method="POST">
    @csrf

    <!-- Course Name -->
    <label for="name">Course Name:</label>
    <input type="text" name="name" id="name" required>
    <br><br>

    <!-- Teacher Select Dropdown -->
    <label for="teacher_id">Teacher:</label>
    <select name="teacher_id" id="teacher_id" required>
        <option value="">-- Select Teacher --</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>
    <br><br>

    <button type="submit">Save</button>
</form>
