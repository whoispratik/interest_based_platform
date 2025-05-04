<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkAllController extends Controller
{
    //
    public function update(Request $request) {
        $request->user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'All notifications marked as read');
    }
}
