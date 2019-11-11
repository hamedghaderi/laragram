<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AvatarsController extends Controller
{
    public function store(User $user)
    {
        request()->validate([
            'avatar'  => 'required|image|file|max:1024'
        ]);

        $filename = \request()->file('avatar')->hashName();

        \request()->file('avatar')->storeAs('/avatars/', $filename, 'public');

        $user->addAvatar($filename);

        return response()->json([
            'data' => $user,
            'status' => 201
        ]);
    }
}
