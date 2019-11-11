<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function show(User $user)
    {
        return view('settings.show', compact('user'));
    }
}
