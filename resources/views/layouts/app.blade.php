<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
</head>
<body x-data="{ open: false }" @keydown.escape="open = false" class="font-sans antialiased">

@include('layouts.aside.index', ['position' => 'left'])

<div class="flex-grow xl:ml-80">
    @include('layouts.aside.navigation-hamburger')
    @include('layouts.aside.index', ['position' => 'right'])

    <main>
        {{ $slot }}
    </main>

    @stack('modals')

    @livewireScripts
</div>
<script>
    const setFillHeight = () => {
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    }
    window.addEventListener('resize', setFillHeight);
    setFillHeight();
    window.onload = function () {
        document.getElementById('nav-right').classList.remove('hidden');
    };
</script>
</body>
</html>
