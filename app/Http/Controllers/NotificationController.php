<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    //
    public function index(Request $request){
        return inertia('User/Notification',
        [
            'notifications' =>$request->input('filter') === 'all' ? $request->user()->notifications()->paginate(10)->withQueryString() : $request->user()->unreadNotifications()->paginate(10)->withQueryString(),
            'filter' => $request->input('filter')
        ]
        );
    }
    public function update(DatabaseNotification $notification) {
        $notification->markAsRead();
        return redirect()->back()->with('success','Notification marked as read');
    }
    public function destroy(DatabaseNotification $notification){
        $notification->delete();
        return redirect()->back()->with('success', 'Notification deleted');
    }
}
