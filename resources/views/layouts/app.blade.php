<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <meta name="description"
        content="منصة عرطه - سوق إلكتروني متكامل لبيع وشراء كل ما تحتاجه: سيارات، أثاث، ملابس، إلكترونيات، عقارات، وأشياء أخرى كثيرة. ابحث، اعرض، وتواصل بسهولة.">
    <meta name="keywords"
        content="منصة عرطه، بيع سيارات، بيع أثاث، بيع ملابس، سوق إلكتروني، مستعمل، جديد، حراج، بيع وشراء، عقارات، إلكترونيات">
    <meta name="author" content="Arttah Platform">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="منصة عرطه | بيع وشراء سيارات، أثاث، ملابس وأكثر">
    <meta property="og:description"
        content="منصة عرطه وجهتك الأولى للبيع والشراء بكل سهولة. سيارات، أثاث، ملابس، عقارات، إلكترونيات وأكثر - كل شيء في مكان واحد.">
    {{-- <meta property="og:image" content="{{ asset('images/preview.png') }}"> --}}
    <meta property="og:image" content="{{ asset('favicons/favicon-96x96.png') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="منصة عرطه | بيع وشراء سيارات، أثاث، ملابس وأكثر">
    <meta name="twitter:description"
        content="منصة عرطه سوق إلكتروني شامل لبيع وشراء كل ما تحتاجه - سيارات، أثاث، ملابس، إلكترونيات، عقارات وأكثر.">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/web-app-manifest-192x192.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicons/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicons/site.webmanifest') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/favicon-96x96.png') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
