@extends('layouts.app')

@section('content')
    <div class="w-3/4 mx-auto py-12">
        <post-page :data="{{ $posts }}"></post-page>
    </div>
@endsection