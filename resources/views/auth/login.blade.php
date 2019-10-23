<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div id="app" class="w-full flex">
    <div class="w-1/2 bg-white h-screen">
        <div class="pt-8 px-12 mb-32">
            <img class="w-32" src="{{ asset('images/logo.svg') }}" alt="Laragram">
        </div>

        <div class="px-24 bg-white rounded">
            <h4 class="text-3xl text-gray-900 font-bold mb-8 tracking-wide">Log in</h4>

            <form method="POST" action="{{ route('login') }}" class="mb-12">
                @csrf

                <div class="mb-8">
                    <label for="email" class="text-gray-500 font-semibold mb-4 block">Email Address</label>

                    <input id="email"
                           type="email"
                           class="border-transparent border-b border-gray-300 w-full focus:outline-none
                               focus:border-indigo-500 text-sm pb-4
                               placeholder-gray-400
                               @error('email') is-danger @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus
                           placeholder="you@example.com">

                    <div class="col-md-6">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <label for="password" class="text-gray-500 font-semibold mb-4 block">Password</label>

                    <input id="password"
                           type="password"
                           class="border-transparent border-b border-gray-300 w-full focus:outline-none pb-4
                               placeholder-gray-400 focus:border-indigo-500 text-sm px-3 @error('password')
                                   is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="Enter your password">

                    <div class="col-md-6">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex items-center">
                        <input class="mr-3" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="text-gray-500 font-semibold block" for="remember">
                            {{ __('Keep me log in') }}
                        </label>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <div class="flex items-center font-semibold tracking-wide">
                        <button type="submit" class="button-primary">Login
                        </button>

                        @if (Route::has('password.request'))
                            <a class="text-sm ml-auto text-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            <p class="text-gray-700">Do not have an account? <a class="pl-1 text-indigo-500 font-bold tracking-wide"
                                                                href="{{
            route('register')
            }}">Sing
                    up</a></p>
        </div>
    </div>

    <div class="w-1/2 h-screen bg-indigo-100 relative">
        <img class="w-full absolute bottom-0 mb-24 right-0" src="{{ asset('images/login.svg') }}" alt="login form">
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
