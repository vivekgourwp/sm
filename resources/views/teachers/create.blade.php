<!-- resources/views/teachers/create.blade.php -->


    <h2>Add teacher</h2>

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>        
        <button type="submit">Save</button>
    </form>

