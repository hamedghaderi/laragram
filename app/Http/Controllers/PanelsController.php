<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PanelsController extends Controller
{
    public function show(User $user)
    {
       return view('panels.show', compact('user'));
    }
}
