<?php

namespace App\Http\Controllers;

use App\User;

class SearchController extends Controller
{
    public function show()
    {
        $search = request('q');

        $users = User::search($search)->paginate(25);

        if (request()->expectsJson()) {
            return $users;
        }

        return view('users.index', compact('users'));
    }
}
