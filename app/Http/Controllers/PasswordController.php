<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function update(User $user)
    {
        request()->validate([
            'current-password' => 'required|min:8|string',
            'password' => 'required|min:8|string|confirmed',
        ]);

        if (! Hash::check(request('current-password'), $user->password)) {
            throw ValidationException::withMessages([
                'current-password' => ['password is not correct'],
            ]);
        }

        $user->update([
            'password' => Hash::make(request('password'))
        ]);

        return back();
    }
}
