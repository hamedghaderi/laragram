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
    <nav class="bg-white py-12 px-4 border-r border-gray-400 fixed pin-l min-h-screen w-64">
        <a class="block w-48 mb-12 mx-auto" href="{{ url('/') }}">
            <img class="w-full" src="{{ asset('images/logo.svg') }}" alt="laragram">
        </a>

        <div class="flex items-center justify-center mb-3">
            <avatar :user="{{$user}}"></avatar>
        </div>

        <!-- Right Side Of Navbar -->
        <ul class="flex items-center justify-center flex-wrap">
            <!-- Authentication Links -->
            @auth
                <li class="nav-item w-full">
                    <a id="navbarDropdown" class="mr-8 inline-flex w-full justify-center text-gray-500" href="#"
                       role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="block text-center text-sm mb-12">
                        @if (strlen($user->username) > 20)
                            <span title="{{ $user->username }}" class="text-indigo-700">{{ '@' . substr($user->username,
                             0, 20) }}..
                            .</span>
                        @else
                            <span class="text-indigo-700">{{ '@' . $user->username }}</span>
                        @endif
                    </div>

                    <div class="text-indigo-500" aria-labelledby="navbarDropdown">
                        <a class="mr-8 inline-flex w-full justify-center text-sm text-red-500" href="{{ route('logout')
                         }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endauth
        </ul>
</nav>

<main class="p-12">
    @yield('content')
</main>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
