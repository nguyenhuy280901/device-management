<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <base href="{{ asset('') }}"/>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/all.min.css">
    @vite('resources/sass/app.scss')

    <!-- Page CSS -->
    @yield('page-css')

    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div id="app">
        @auth
            @include('layouts.sidebars')
            
            <div id="main">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif

                @error('message')
                    <div class="alert alert-danger" role="alert">
                        {{ implode(', ', $errors->all()) }}
                    </div>
                @enderror
                
                <div class="page-wrapper">
                    <!-- Page title -->
                    @include('layouts.page-title')

                    <!-- Page content -->
                    @yield('content')
                </div>
            </div>
        @else
            @yield('content')
        @endauth
    </div>

    @auth
        <script>
            window.User = {
                id: {{ auth()->user()->id }},
                departmentId: {{ auth()->user()->department_id }},
            }
        </script>
    @endauth

    <!-- Scripts -->
    <script src="vendor/js/jquery-3.6.1.min.js"></script>
    <script src="vendor/js/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    {{-- @vite('resources/js/app.js', 'build') --}}
    @vite('resources/js/app.js')
    
    <!-- Page JS -->
    @yield('page-js')
    
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
