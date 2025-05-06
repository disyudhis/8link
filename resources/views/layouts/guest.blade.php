<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ asset('build/assets/app-_9wNWyRU.css') }}">
        <script type="module" src="{{ asset('build/assets/app-T1DpEqax.js') }}"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="font-sans antialiased">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
