<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laragram') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="bg-white py-4 border-b border-gray-400">
            <div class="container">
                <div class="flex items-center justify-between">
                    <a class="block w-48" href="{{ url('/') }}">
                        <img class="w-full" src="{{ asset('images/logo.svg') }}" alt="laragram">
                    </a>

                    <div class="w-1/3">
                        <form action="/users/search" method="GET">
                            <div class="flex relative justify-center items-center">
                                <algolia-search token="{{ config('scout.algolia.key') }}" identification="{{ config('scout.algolia.id') }}"></algolia-search>

{{--                                <input class="bg-gray-200 pl-12 pr-4 py-2 rounded w-full border focus:outline-none--}}
{{--                                focus:border-indigo-500"--}}
{{--                                       placeholder="Know anyone...?"--}}
{{--                                       type="text"--}}
{{--                                       name="q">--}}
                                <span class="absolute left-0 ml-4 text-gray-500">
                                    <svg class="fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0
                                     24 24"
                                         width="24"
                                          height="24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
                                </span>
                            </div>

                        </form>
                    </div>

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
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
