<h2>Student List</h2>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Alter Phone</th>
            <th>City</th>
            <th>State</th>            
            <th>Country</th>
            <th>Post code</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($students as $student)
            <tr>
                <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
                <td>{{ $student->date_of_birth }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ optional($student->contact)->email ?? 'N/A' }}</td>
                <td>{{ optional($student->contact)->phone_number ?? 'N/A' }}</td>
                <td>{{ optional($student->contact)->alternate_phone ?? 'N/A' }}</td>
                <td>{{ optional($student->contact)->city ?? 'N/A' }}</td>
                <td>{{ optional($student->contact)->state ?? 'N/A' }}</td>
                <td>{{ optional($student->contact)->country ?? 'N/A' }}</td>
                <td>{{ optional($student->contact)->postal_ccode ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('students.edit', $student->id) }}">Edit</a> |
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure to delete this student?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:red;">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No students found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
