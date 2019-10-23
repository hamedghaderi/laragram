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
    <div class="h-screen bg-white w-1/2">
        <div class="pt-8 px-12 mb-32">
            <img class="w-32" src="{{ asset('images/logo.svg') }}" alt="Laragram">
        </div>

        <div class="px-24">
            <h4 class="text-3xl text-gray-900 font-bold mb-8 tracking-wide">Register</h4>

            <form method="POST" action="{{ route('register') }}" class="mb-12">
                @csrf

                <div class="mb-8">
                    <label for="name" class="text-gray-500 font-semibold mb-4 block">Name</label>

                    <input id="name"
                           type="text"
                           class="border-transparent border-b border-gray-300 w-full focus:outline-none
                               focus:border-indigo-500 text-sm pb-4
                               placeholder-gray-400 @error('name') is-danger @enderror"
                           name="name"
                           placeholder="Your name"
                           value="{{ old('name') }}"
                           required
                           autocomplete="name"
                           autofocus>

                    <div class="col-md-6">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <label for="email" class="text-gray-500 font-semibold mb-4 block">E-mail Address</label>

                    <input id="email"
                           type="email"
                           class="border-transparent border-b border-gray-300 w-full focus:outline-none pb-4
                               placeholder-gray-400 focus:border-indigo-500 text-sm px-3 @error('email') is-danger @enderror"
                           name="email"
                           placeholder="you@example.com"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email">


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
                               placeholder-gray-400 focus:border-indigo-500 text-sm px-3 @error('password') is-danger @enderror"
                           name="password"
                           placeholder="********"
                           required
                           autocomplete="new-password">

                    <div class="col-md-6">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <label for="password-confirm" class="text-gray-500 font-semibold mb-4 block">Confirm
                        Password</label>

                    <input id="password-confirm"
                           type="password"
                           class="border-transparent border-b border-gray-300 w-full focus:outline-none pb-4
                               placeholder-gray-400 focus:border-indigo-500 text-sm px-3"
                           name="password_confirmation"
                           placeholder="********"
                           required
                           autocomplete="new-password">
                </div>

                <div class="form-group mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="bg-indigo-600 text-white px-32 py-3
                            rounded-b-full rounded-tl-full shadow-lg hover:shadow-md font-bold
                            tracking-widest text-sm uppercase">Register
                        </button>
                    </div>
                </div>
            </form>

            <p class="text-gray-700">Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-500
            pl-1
            font-bold
            tracking-wide">Log
                    in</a></p>
        </div>
    </div>

    <div class="w-1/2 h-screen bg-indigo-100 relative">
        <img class="w-full absolute bottom-0 mb-24 right-0" src="{{ asset('images/signup.svg') }}" alt="Lighthouse">
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>