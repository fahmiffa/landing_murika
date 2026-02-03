<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MURIKA') }}</title>
    <link rel="icon" href="{{ asset('murika.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="font-sans antialiased bg-slate-50">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-900/80 md:hidden"></div>

        <!-- Sidebar -->
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-white transition-transform duration-500 ease-in-out md:translate-x-0 md:static md:inset-0 shadow-2xl shadow-orange-100 md:shadow-none">
            <livewire:layout.navigation />
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <!-- Mobile Top Bar -->
            <div class="md:hidden flex items-center justify-between bg-white border-b border-orange-100 px-6 py-4">
                <div class="flex items-center gap-3">
                    <x-application-logo class="w-auto h-8" />
                </div>
                <button @click="sidebarOpen = true" class="p-2 rounded-xl text-orange-500 bg-orange-50 hover:bg-orange-100 transition-colors focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <!-- Page Heading -->
            @if (isset($header))
            <header class="bg-white/80 backdrop-blur-md border-b border-orange-50 sticky top-0 z-30">
                <div class="max-w-7xl mx-auto py-5 px-6 sm:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <footer class="py-4 text-center text-sm text-gray-500 bg-white md:bg-transparent border-t md:border-t-0">
                &copy; {{ date('Y') }} {{ config('app.name', 'MURIKA') }}
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>

</html>