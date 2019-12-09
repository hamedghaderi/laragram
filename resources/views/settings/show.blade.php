@extends('layouts.dashboard')

@section('content')
    <div class="bg-white shadow ml-64 rounded p-8 mb-12">
        <h2 class="pb-4 text-gray-600 font-bold tracking-wider uppercase text-xl">Change Your Settings</h2>

        <hr class="mb-8">

        <form action="{{ $user->path() }}" method="POSt">
            @csrf
            @method("PATCH")

            <div class="flex mb-4 -mx-2">
                <div class="mb-4 w-1/3 px-2">
                    <label class="block text-gray-600 mb-1" for="name">Name</label>
                    <input class="w-full bg-gray-200 px-4 py-2 rounded text-gray-700" type="text" name="name" value="{{
                $user->name }}">
                </div>

                <div class="mb-4 w-1/3 px-2">
                    <label class="block text-gray-600 mb-1" for="email">Email</label>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div>
                <button class="rounded bg-green-700 text-white px-4 py-2 hover:bg-green-800" type="submit">Save
                    Updates</button>
            </div>


        </form>
    </div>

    <div class="bg-white shadow ml-64 rounded p-8 mb-12">
        <h2 class="pb-4 text-gray-600 font-bold tracking-wider uppercase text-xl">Change Your Username</h2>

        <hr class="mb-8">

        <form action="{{ $user->path() . '/username' }}" method="POST">
            @csrf
            @method("PATCH")

            <div class="flex mb-4 -mx-2">
                <div class="mb-4 w-1/3 px-2">
                    <label class="block text-gray-600 mb-1" for="username">Username</label>
                    <input class="w-full bg-gray-200 px-4 py-2 rounded text-gray-700 @error('username') border
                    border-red-500
                    @enderror
                    }}"
                           type="text"
                           name="username"
                           value="{{ old('username') ? old('username') :
                $user->username }}">

                    @error('username')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button class="rounded bg-green-700 text-white px-4 py-2 hover:bg-green-800" type="submit">Save
                    Updates</button>
            </div>

        </form>
    </div>

    <div class="bg-white shadow ml-64 rounded p-8">
        <h2 class="pb-4 text-gray-600 font-bold tracking-wider uppercase text-xl">Change Your Password</h2>

        <hr class="mb-8">

        <form action="{{ $user->path() . '/password' }}" method="POST">
            @csrf
            @method("PATCH")

            <div class="flex mb-4 -mx-2 border-b border-gray-300">
                <div class="mb-4 w-1/3 px-2">
                    <label class="block text-gray-600 mb-1" for="password">Current Password</label>
                    <input class="w-full bg-gray-200 px-4 py-2 rounded text-gray-700 @error('current-password') border
                    border-red-500
                    @enderror
                            }}"
                           type="password"
                           name="current-password" placeholder="***********">

                    @error('current-password')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex mb-4 -mx-2">
                <div class="mb-4 w-1/3 px-2">
                    <label class="block text-gray-600 mb-1" for="password">Password</label>
                    <input class="w-full bg-gray-200 px-4 py-2 rounded text-gray-700 @error('password') border
                    border-red-500
                    @enderror
                            }}"
                           type="password"
                           name="password" placeholder="***********">

                    @error('password')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 w-1/3 px-2">
                    <label class="block text-gray-600 mb-1" for="password_confirmation">Password Confirmation</label>
                    <input class="w-full bg-gray-200 px-4 py-2 rounded text-gray-700"
                           type="password"
                           name="password_confirmation"
                           placeholder="***********">
                </div>
            </div>

            <div>
                <button class="rounded bg-green-700 text-white px-4 py-2 hover:bg-green-800" type="submit">Save
                    Updates</button>
            </div>

        </form>
    </div>
@endsection