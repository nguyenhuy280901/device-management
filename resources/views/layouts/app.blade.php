<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('') }}vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('') }}css/app.css">
    <link rel="stylesheet" href="{{ asset('') }}css/style.css">
    
</head>
<body>
    <div id="app">
        @include('layouts.sidebars')

        <div id="main">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('') }}vendor/js/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('') }}vendor/js/popper.min.js"></script>
    <script src="{{ asset('') }}vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('') }}js/main.js"></script>
    <script src="{{ asset('') }}js/script.js"></script>

</body>
</html>
