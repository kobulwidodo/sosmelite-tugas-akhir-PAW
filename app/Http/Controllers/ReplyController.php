<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use App\Models\Status;
use Auth;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Status $status, ReplyRequest $replyRequest)
    {
        Auth::user()->makeReply($status->id, $replyRequest->body);
        return back()->with('message', 'Berhasil membuat komentar');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();
        return back()->with('message', 'Berhasil menghapus komentar');
    }
}
