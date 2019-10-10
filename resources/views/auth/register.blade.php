@extends('layouts.app')

@section('content')
<div class="container">
        <div class="w-1/2 mx-auto">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="label">Name</label>

                            <input id="name"
                                   type="text"
                                   class="input @error('name') is-danger @enderror"
                                   name="name"
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

                        <div class="form-group">
                            <label for="email" class="label">E-mail Address</label>

                            <input id="email"
                                   type="email"
                                   class="input @error('email') is-danger @enderror"
                                   name="email"
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

                        <div class="form-group">
                            <label for="password" class="label">Password</label>

                            <input id="password"
                                   type="password"
                                   class="input @error('password') is-danger @enderror"
                                   name="password"
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

                        <div class="form-group">
                            <label for="password-confirm" class="label">Confirm Password</label>

                            <input id="password-confirm"
                                   type="password"
                                   class="input mb-6"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password">
                        </div>

                        <div class="form-group mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
