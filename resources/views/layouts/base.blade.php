<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ asset('build/assets/app-DsCgSF38.css') }}">
        <script type="module" src="{{ asset('build/assets/app-T1DpEqax.js') }}"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @stack('style')
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100">
    <header class="fixed top-0 left-0 right-0 z-30 bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-black rounded-full flex items-center justify-center">
                            <img src="{{ asset('icon/8link yellow (no bg).png') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 overflow-hidden pt-16 pb-20">
        <!-- Scrollable Container -->
        <div class="h-full overflow-y-auto">
            <!-- Content -->
            <div class="container mx-auto">
                {{ $slot }}
            </div>
        </div>
    </main>

    @if (isset($bottomNavigation))
        <div class="fixed bottom-0 left-0 right-0 z-10 bg-white border-t border-gray-200 shadow-lg">
            {{ $bottomNavigation }}
        </div>
    @endif

    @livewireScripts
    @stack('script')
</body>

</html>
