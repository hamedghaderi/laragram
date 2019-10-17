<?php

namespace App\Http\Controllers;

use App\User;

class FollowingsController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->follow($user);
    }
}
