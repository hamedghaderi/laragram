@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 py-8 border border-b w-full">
        <div class="container">
            <div class="flex items-center">
                <div class="w-1/2">
                    <div class="flex items-center">
                        <img style="width: 70px;" class="mr-2" src="{{ asset('images/avatar.svg') }}" alt="Avatar">
                        <h3 class="font-bold text-gray-700 tracking-wide">{{ $user->name }}</h3>
                    </div>
                </div>

                <div class="w-1/2 text-right">
                    <form action="/members/{{ $user->id }}" method="POST">
                        @csrf
                        @if (auth()->user()->hasRequestedFollowing($user))
                            <button class="bg-red-100 text-red-700 rounded px-4 py-2">Cancel Request</button>
                        @else
                            <button class="bg-green-100 text-green-700 rounded px-4 py-2">Follow</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection