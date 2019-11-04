<?php

namespace App\Http\Controllers;

use App\User;

/**
 * Class FollowingsController
 *
 * @package App\Http\Controllers
 */
class FollowingsController extends Controller
{
    /**
     * Accept following a user
     *
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(User $user)
    {
        auth()->user()->follow($user);

        return back();
    }

    public function destroy(User $user)
    {
        auth()->user()->followings()->detach($user->id);

        return back();
    }
}
