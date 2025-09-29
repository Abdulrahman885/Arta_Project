
<!doctype html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'منصة عرطه | بيع وشراء كل ما تحتاجه')</title>

    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    {{-- Meta tags ديناميكية --}}
    <meta name="description" content="@yield('meta_description', 'منصة عرطه - سوق إلكتروني متكامل لبيع وشراء كل ما تحتاجه')">
    <meta name="keywords" content="@yield('meta_keywords', 'منصة عرطه، بيع سيارات، بيع أثاث، سوق إلكتروني، مستعمل، جديد')">
    <meta name="author" content="Arttah Platform">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('meta_og_title', 'منصة عرطه | بيع وشراء سيارات، أثاث، ملابس وأكثر')">
    <meta property="og:description" content="@yield('meta_og_description', 'منصة عرطه وجهتك الأولى للبيع والشراء بكل سهولة.')">
    <meta property="og:image" content="@yield('meta_og_image', asset('favicons/favicon-96x96.png'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('meta_twitter_title', 'منصة عرطه | بيع وشراء سيارات، أثاث، ملابس وأكثر')">
    <meta name="twitter:description" content="@yield('meta_twitter_description', 'منصة عرطه سوق إلكتروني شامل لبيع وشراء كل ما تحتاجه')">

    {{-- Favicons --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/web-app-manifest-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/favicon-96x96.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">

    @livewireStyles
</head>
<body>
    @include('layouts.navbar')

  @yield('contact')

    @include('layouts.footer')

    <script src="{{ asset('assets/Js/custom-Js.js') }}"></script>
    @livewireScripts
</body>
</html>
