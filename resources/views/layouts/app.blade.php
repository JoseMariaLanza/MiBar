<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MiBar') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    {!! javascript_ts('/js/app.js') !!}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/Icons/favicon-32x32.png">
</head>
<body>
    <div id="app">
        <!-- Original: bg-white -->
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#363435;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/ventas/create') }}">
                    <img src="/images/Caprice-Logo.jpeg" alt="CAPRICE" height="50" width="50">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    @can('menu.index')
                        <a class="navbar-brand text-white" href="{{ route('menu.index') }}">Menú</a>
                    @endcan
                    @can('mesas.index')
                        <a class="navbar-brand text-white" href="{{ route('mesas.index') }}">Mesas</a>
                    @endcan
                    @can('cajas.index')
                        <a class="navbar-brand text-white" href="{{ route('cajas.index') }}">Caja</a>
                    @endcan
                    @can('users.index')
                        <a class="navbar-brand text-white" href="{{ route('users.index') }}">Usuarios</a>
                    @endcan
                    @can('roles.index')
                        <a class="navbar-brand text-white" href="{{ route('roles.index') }}">Roles</a>
                    @endcan
                    @can('gastos.index')
                        <a class="navbar-brand text-white" href="{{ route('gastos.index') }}">Gastos</a>
                    @endcan
                    @can('ventas.index')
                        <a class="navbar-brand text-white" href="{{ route('ventas.index') }}">Ventas</a>
                    @endcan
                    @can('ventas.create')
                        <a class="navbar-brand text-white" href="{{ route('ventas.create') }}">Vender</a>
                    @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href=" {{ route('Empleado.Detalles', Auth::user()->id) }}">
                                     Perfil
                                     </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
