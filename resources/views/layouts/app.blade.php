<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="愛媛県今治市で数学・物理専門の進学塾を展開する戸田塾の映像授業配信サービスです。通学している高校関係なく、難関大学突破を目指します。" name="description">
    <meta name="keywords" content="今治,大学受験専門,数学,物理">
    <meta name="google-site-verification" content="YkUvXIDlU-C3u33aX_mLi1Xx5aPExDRWOQkQ6EVEal4" />

    <title>戸田塾オンライン | 大学受験専門 数学・物理【愛媛県今治市】</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@400;500;700&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    @includeWhen(env('APP_ENV') == 'production', 'layouts.google-analytics')
</head>

<header class="bg-white h-16 fixed xl:hidden shadow top-0 w-full z-40">
    <a href="{{ route('home') }}" class="inline-block ml-3 mt-2 px-2">
        <x-jet-application-mark/>
        <h1 class="inline-block font-semibold text-lg tracking-wider ml-2 relative top-0.5">戸田塾オンライン</h1>
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
    </div>

    @livewireScripts
    <script>
        const setFillHeight = () => document.documentElement.style.setProperty('--vh', `${window.innerHeight * 0.01}px`)
        window.addEventListener('resize', setFillHeight)
        window.onload = () => document.getElementById('nav-right').classList.remove('hidden')
    </script>
</body>
</html>
