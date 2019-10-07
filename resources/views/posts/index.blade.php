@extends('layouts.master')

@section('content')
    <div class="w-3/4 mx-auto py-12">
        <file-uploader @uploaded="uploaded">
        </file-uploader>

        <div class="flex -mx-6 flex-wrap">
            @foreach ($posts as $post)
               <div class="w-1/3 mb-12">
                   <div class="px-6">
                       <div class="w-full h-64" style="background-image:url({{ asset('storage/' . $post->path) }});
                               background-repeat: no-repeat; background-size: cover;"></div>
                   </div>
{{--                   <img src="/storage/{{ $post->path }}" alt="test" class="w-full">--}}
               </div>
            @endforeach
        </div>
    </div>
@endsection