<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VideoFlex</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-neutral-900 text-white min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="index.html" class="inline-flex items-center space-x-3">
                <i class="fas fa-play-circle text-red-500 text-4xl"></i>
                <span class="text-2xl font-bold text-neutral-100">VideoFlex</span>
            </a>
        </div>
        @yield('content')
    </div>
</body>
</html>
