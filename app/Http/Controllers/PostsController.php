<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function store()
    {
        request()->validate([
            'image' => 'required|file|image|mimes:jpeg,png,gif'
        ]);

        $filePath = request()->file('image')->storeAs('/images', request()->file('image')->hashName(), 'public');

        Post::create([
            'path' => $filePath
        ]);

        return back();
    }
}
