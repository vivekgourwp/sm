<!-- resources/views/students/create.blade.php -->


    <h2>Add Student</h2>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <button type="submit">Save</button>
    </form>

