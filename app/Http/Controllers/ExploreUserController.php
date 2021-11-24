<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ExploreUserController extends Controller
{
    public function __invoke()
    {
        // dd(User::join('follows', 'users.id', '=', 'follows.following_user_id')->select('users.*', 'count(follows.following_user_id)')->get());
        return view('users.index', [
            "users" => User::withCount('followers')->orderBy('followers_count', 'desc')->paginate(12),
        ]);
    }
}
