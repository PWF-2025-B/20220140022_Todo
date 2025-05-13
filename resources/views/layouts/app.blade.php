<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Todo App') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS + Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
    @stack('scripts')

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #111827; /* Tailwind bg-gray-900 */
        }
    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        
        <!-- Navbar -->
        @include('layouts.navigation')

        <!-- Main Content Area -->
        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            @yield('content')
        </main>
    </div>
</body>
</html>
