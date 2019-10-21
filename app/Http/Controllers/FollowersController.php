<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
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
