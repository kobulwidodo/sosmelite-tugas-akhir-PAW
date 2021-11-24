<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimelineController extends Controller
{
    public function __invoke()
    {
        $followings = Auth::user()->follows;
        $statuses = Status::withCount('replies')->with('user')->whereIn('user_id', $followings->pluck('id'))->orWhere('user_id', Auth::user()->id)->latest()->get();
        return view('timeline', compact('statuses', 'followings'));
    }
}
