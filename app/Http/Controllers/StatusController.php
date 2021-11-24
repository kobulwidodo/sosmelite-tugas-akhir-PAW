<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{

    public function show(Status $status) {
        $replies = $status->replies()->with('user')->latest()->get();
        return view('status', ['status' => $status, 'replies' => $replies]);
    }

    public function store(StatusRequest $request)
    {
        Auth::user()->makeStatus($request->body);

        return redirect()->back();
    }

    public function update(StatusRequest $request, Status $status)
    {
        $this->authorize('update', $status);
        $status->update($request->all());
        return back()->with('message', 'Berhasil merubah status');
    }

    public function destroy(Status $status)
    {
        $this->authorize('delete', $status);
        $status->delete();
        return redirect(route('timeline'))->with('message', 'Berhasil menghapus status');
    }
}
