<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MURIKA') }} - Login</title>
    <link rel="icon" href="{{ asset('murika.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .bg-orange-gradient {
            background: linear-gradient(135deg, #fffcf9 0%, #fff7ed 100%);
        }

        .orange-pattern {
            background-color: #fff7ed;
            background-image: radial-gradient(#fb923c 0.5px, transparent 0.5px), radial-gradient(#fb923c 0.5px, #fff7ed 0.5px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            opacity: 0.05;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased bg-orange-gradient">
    <div class="min-h-screen relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Abstract Decors -->
        <div class="absolute orange-pattern inset-0"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-orange-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-orange-200 rounded-full blur-3xl opacity-30"></div>

        <div class="relative w-full max-w-md">
            <div class="text-center mb-8">
                <a href="/" wire:navigate class="inline-block transform hover:scale-105 transition-transform duration-300">
                    <x-application-logo class="w-28 h-16 mx-auto drop-shadow-sm" />
                </a>
            </div>

            <div class="bg-white/80 backdrop-blur-xl shadow-2xl shadow-orange-200/50 rounded-3xl p-8 sm:p-10 border border-white/20">
                {{ $slot }}
            </div>

            <div class="text-center mt-8">
                <p class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} {{ config('app.name', 'MURIKA') }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>