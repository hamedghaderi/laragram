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
        $posts = auth()->user()->posts;

        return view('posts.index', compact('posts'));
    }

    public function store()
    {
        request()->validate([
            'image' => 'required|file|image|mimes:jpeg,png,gif'
        ]);

        $filePath = request()->file('image')->storeAs('/images', request()->file('image')->hashName(), 'public');

        $post = auth()->user()->posts()->create([
            'path' => $filePath
        ]);

        if (\request()->wantsJson()) {
            return $post;
        }

        return back();
    }

    public function destroy(Post $post)
    {
        if (auth()->id() != $post->owner_id)  {
            abort(403);
        }

        $post->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 200
            ]);
        }

        return redirect('/posts');
    }
}
