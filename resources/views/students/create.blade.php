<!-- resources/views/students/create.blade.php -->

<h2>Add Student</h2>

<form action="{{ route('students.store') }}" method="POST">
    @csrf

    <!-- Student Info -->
    <label for="first_name">First Name: *</label><br>
    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
    @error('first_name')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="middle_name">Middle Name:</label><br>
    <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
    @error('middle_name')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="last_name">Last Name: *</label><br>
    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
    @error('last_name')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="gender">Gender: *</label><br>
    <select name="gender" id="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
    </select>
    @error('gender')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="date_of_birth">Date of Birth: *</label><br>
    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
    @error('date_of_birth')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <!-- Contact Info -->
    <label for="email">Email: *</label><br>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    @error('email')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="phone_number">Phone Number: *</label><br>
    <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
    @error('phone_number')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="address_line1">Address Line 1: *</label><br>
    <input type="text" name="address_line1" id="address_line1" value="{{ old('address_line1') }}" required>
    @error('address_line1')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="address_line2">Address Line 1: *</label><br>
    <input type="text" name="address_line2" id="address_line2" value="{{ old('address_line2') }}" required>
    @error('address_line2')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="city">City: *</label><br>
    <input type="text" name="city" id="city" value="{{ old('city') }}" required>
    @error('city')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="state">State:</label><br>
    <input type="text" name="state" id="state" value="{{ old('state') }}">
    @error('state')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="postal_code">Postal Code:</label><br>
    <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}">
    @error('postal_code')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <label for="country">Country:</label><br>
    <input type="text" name="country" id="country" value="{{ old('country') }}">
    @error('country')<div style="color:red;">{{ $message }}</div>@enderror
    <br><br>

    <button type="submit">Save Student</button>
</form>
