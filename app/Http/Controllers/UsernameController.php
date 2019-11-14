<?php

namespace App\Http\Controllers;

use App\User;

class UsernameController extends Controller
{
    public function update(User $user)
    {
        $attributes = request()->validate([
            'username' => 'required|string|alpha_dash|min:3|max:255|unique:users,username,' . $user->id
        ]);

        $user->update($attributes);

        return back();
    }
}
