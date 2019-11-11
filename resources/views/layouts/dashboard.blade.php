<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laragram') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="bg-white py-12 px-4 border-r border-gray-400 fixed pin-l min-h-screen" style="width: 300px;">
        <a class="block w-48 mb-12" href="{{ url('/') }}">
            <img class="w-full" src="{{ asset('images/logo.svg') }}" alt="laragram">
        </a>

        <avatar :user="{{$user}}"></avatar>

        <!-- Right Side Of Navbar -->
        <ul class="flex">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item flex">
                    <a id="navbarDropdown" class="mr-8 text-indigo-500" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="text-indigo-500" aria-labelledby="navbarDropdown">
                        <a href="{{ route('logout') }}"
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
</nav>

<main>
    @yield('content')
</main>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
