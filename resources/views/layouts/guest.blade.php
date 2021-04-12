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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>
    @includeWhen(env('APP_ENV') == 'production', 'layouts.google-analytics')
</head>
<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>
</html>
