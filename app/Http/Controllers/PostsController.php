<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.
    }

    public function index()
    {
        $posts = POST::all();

        return view('posts.index', compact('posts'));
    }

    public function store()
    {
        request()->validate([
            'image' => 'required|file|image|mimes:jpeg,png,gif'
        ]);

        $filePath = request()->file('image')->storeAs('/images', request()->file('image')->hashName(), 'public');

        $post = Post::create([
            'path' => $filePath
        ]);

        if (\request()->wantsJson()) {
            return $post;
        }

        return back();
    }
}
