<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-vlOMx0hKjUCl4WzuhIhSNZSm2yQCaf0mOU1hEDK/iztH3gU4v5NMmJln9273A6Jz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @guest
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="/" class="nav-link pr-2">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="/cards" class="nav-link pr-2">Cátalogo de Cartões</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link pr-2">Cadastre-se</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="/login" class="nav-link pr-2">Login</a>
                            </li>
                        </ul>
                    @else
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a href="/home" class="nav-link pr-2">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="/cards" class="nav-link pr-2">Cátalogo de Cartões</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="navbarDropdown" class="nav-link dropdown-toggle" v-pre>
                                    Olá, {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu border-0 dropdown-menu-right bg-dark text-center mx-0 px-0" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-0 dropdown-item b-none text-white">
                                        {{ __('Sair') }}
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="container py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>