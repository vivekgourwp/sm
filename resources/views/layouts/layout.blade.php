<!-- resources/views/layout.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management - @yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @yield('styles')
</head>
<body class="font-sans antialiased">
    <h1 class="text-3xl font-bold text-center my-4">School Management System</h1>
    <hr class="mb-6">
    <div class="container mx-auto px-4">
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>