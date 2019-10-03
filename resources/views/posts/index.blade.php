@extends('layouts.master')

@section('content')
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" name="image">
        <button type="submit">Upload</button>
    </form>

    @foreach ($posts as $post)
        <img src="/storage/{{ $post->path }}" alt="test">
    @endforeach
@endsection