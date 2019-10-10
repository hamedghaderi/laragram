@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="w-1/2 mx-auto">
            <div class="card">
            <div class="card-header">Login</div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="label">Email Address</label>

                        <input id="email"
                               type="email"
                               class="input @error('email') is-danger @enderror"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               autofocus>

                        <div class="col-md-6">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="label">Password</label>

                        <input id="password"
                               type="password"
                               class="input @error('password') is-invalid @enderror"
                               name="password"
                               required
                               autocomplete="current-password">

                        <div class="col-md-6">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-4 mb-8">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <div class="flex">
                            <button type="submit" class="btn btn-primary">Login</button>

                            @if (Route::has('password.request'))
                                <a class="is-link text-sm ml-auto" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection
