@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 py-8 border border-b w-full">
        <div class="container">
            <div class="flex items-center">
                <div class="w-1/2">
                    <div class="flex items-center">
                        <img style="width: 70px;" class="mr-2" src="{{ $user->avatar ? $user->avatar : asset
                        ('images/avatar.svg') }}" alt="Avatar">
                        <h3 class="font-bold text-gray-700 tracking-wide">{{ $user->name }}</h3>
                    </div>
                </div>

                <div class="w-1/2 text-right">
                    @if (auth()->user()->hasRequestedFollowing($user))
                        <form action="/following/{{ $user->id }}/cancel" method="POST">
                            @csrf
                            <button class="bg-red-200 text-red-700 rounded px-4 py-2">Cancel Request</button>
                        </form>
                    @elseif ($user->id != auth()->id())
                            <form action="/members/{{ $user->id }}" method="POST">
                                @csrf
                                <button class="bg-green-200 text-green-700 rounded px-4 py-2">Follow</button>
                            </form>
                    @elseif ($user->id == auth()->id())
                        <a href="{{ route('settings.show', $user->id) }}" class="bg-gray-200 text-gray-700 rounded px-4
                        py-2">Settings</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection