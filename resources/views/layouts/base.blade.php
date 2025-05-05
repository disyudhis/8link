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
        <link rel="stylesheet" href="{{ asset('build/assets/app-DH5eT-FY.css') }}">
        <script type="module" src="{{ asset('build/assets/app-T1DpEqax.js') }}"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        {{ $slot }}
    </div>

    @if (isset($bottomNavigation))
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg">
            {{ $bottomNavigation }}
        </div>
    @endif

    @livewireScripts
</body>

</html>
