<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BantuSesama') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Global styles */
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: #212529;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover {
            color: #0d6efd;
        }

        /* Navbar styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.25rem;
        }

        .navbar-toggler {
            display: none;
            cursor: pointer;
            background-color: #f8f9fa;
            border: none;
            padding: 0.5rem 1rem;
        }

        .navbar-nav {
            list-style: none;
            display: flex;
            gap: 1rem;
        }

        .nav-item {
            display: inline;
        }

        .nav-link {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 500;
            color: #6c757d;
        }

        .nav-link:hover {
            color: #0d6efd;
        }

        /* Dropdown styles */
        .dropdown-menu {
            position: absolute;
            right: 2rem;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0.25rem;
            padding: 0.5rem 0;
            display: none;
            z-index: 1000;
        }

        .dropdown-menu .dropdown-item {
            padding: 0.5rem 1rem;
            color: #212529;
            font-size: 0.9rem;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Content styles */
        main {
            padding: 2rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'BantuSesama') }}
            </a>
            <button class="navbar-toggler" type="button">
                ☰
            </button>
            <ul class="navbar-nav">
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
                    <a id="navbarDropdown" class="nav-link" href="#" role="button">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
