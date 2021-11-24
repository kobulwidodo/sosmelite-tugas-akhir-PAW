<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function store(User $user)
    {
        Auth::user()->hasFollow($user) 
            ? Auth::user()->follows()->detach($user) 
            : Auth::user()->follows()->save($user);

        return redirect()->back()->with('success', 'Berhasil!');
    }
}
