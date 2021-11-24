<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileInformationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user, $type = "")
    {
        if ($type != 'following' && $type != 'followers') {
            return view('users.show', compact('user'));
        } else if ($type == 'following') {
            return view('users.stat', [
                'user' => $user,
                'stats' => $user->follows,
                'type' => 'Following',
            ]);
        } else if ($type == 'followers') {
            return view('users.stat', [
                'user' => $user,
                'stats' => $user->followers,
                'type' => 'Followers',
            ]);
        }
    }

    public function edit() {
        return view('users.edit');
    }

    public function update(Request $request)
    {
        $attr = $request->validate([
            'username' => ['required', 'string', 'max:30', 'min:3', 'unique:users,username,' . auth()->id()],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->id()],
        ]);

        Auth::user()->update($attr);

        return redirect()->route('profile',Auth::user()->username)->with('message', 'Profile berhasil di update');
    }
}
