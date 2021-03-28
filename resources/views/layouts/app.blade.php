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

<header class="bg-white h-16 fixed xl:hidden shadow top-0 w-full z-40">
    <a href="{{ route('home') }}" class="block ml-3 mt-2 px-2">
        <x-jet-application-mark/>
        <h1 class="inline-block font-semibold text-lg tracking-wider ml-2 relative top-0.5">
            戸田塾オンライン</h1>
    </a>
</header>

<body x-data="{ open: false }" @keydown.escape="open = false" class="font-sans antialiased bg-gray-50 pt-16 xl:pt-0">

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
