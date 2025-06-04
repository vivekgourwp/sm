<!-- resources/views/teachers/index.blade.php -->

@extends('layouts.layout')

@section('title', 'teacher Management')

@section('styles')
    <style>
        body {
            background: linear-gradient(to bottom right, #f3f4f6, #e5e7eb);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }
        .table-container {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .table-header {
            background: linear-gradient(to right, #3b82f6, #1e40af);
            color: white;
        }
        .btn {
            transition: all 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .modal {
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: scale(0.95);
        }
        .modal.show {
            transform: scale(1);
            opacity: 1;
        }
        .error {
            color: #dc2626;
            font-size: 0.875rem;
        }
        .success-message {
            animation: fadeOut 5s forwards;
        }
        @keyframes fadeOut {
            0% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; display: none; }
        }
    </style>
@endsection

@section('content')
    <div class="py-10">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg success-message">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900">Teacher Management</h1>
            <button onclick="openAddModal()" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg btn hover:bg-blue-700 flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Teacher
            </button>
        </div>

        @if($teachers->isEmpty())
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <p class="text-gray-500 text-lg">No Teachers found in the database.</p>
            </div>
        @else
            <div class="table-container">
                <table class="w-full bg-white">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr class="border-b hover:bg-gray-50 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                <td class="px-6 py-4 text-gray-cost-800">{{ $teacher->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $teacher->email }}</td>
                                <td class="px-6 py-4 flex space-x-3">
                                    <button onclick="openEditModal('{{ $teacher->id }}', '{{ $teacher->name }}', '{{ $teacher->email }}')"
                                            class="bg-blue-500 text-white px-4 py-2 rounded-lg btn hover:bg-blue-600 flex items-center">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </button>
                                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $teacher->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg btn hover:bg-red-600 flex items-center">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Add teacher Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden modal">
        <div class="bg-white p-8 rounded-xl w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Add New teacher</h2>
            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter teacher name">
                    @error('name')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter teacher email">
                    @error('email')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAddModal()" class="bg-gray-200 text-gray-800 px-5 py-2 rounded-lg btn hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg btn hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit teacher Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden modal">
        <div class="bg-white p-8 rounded-xl w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Edit teacher</h2>
            <form id="editForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" name="name" id="editName" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter teacher name">
                    @error('name')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" name="email" id="editEmail" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter teacher email">
                    @error('email')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-200 text-gray-800 px-5 py-2 rounded-lg btn hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg btn hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
            document.getElementById('addModal').classList.add('show');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
            document.getElementById('addModal').classList.remove('show');
        }

        function openEditModal(id, name, email) {
            document.getElementById('editId').value = id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editForm').action = `{{ url('teachers') }}/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('show');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('show');
        }
    </script>
@endsection