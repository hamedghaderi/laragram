<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->accept($user);

        return back();
    }

    /**
     * Decline a user from followings list.
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        auth()->user()->decline($user);

        return back();
    }
}
