<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class NotificatinsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('authorized', auth()->user());

        $notifications = auth()->user()->notifications()->paginate(20);
        if($notifications)
        {
            auth()->user()->unreadNotifications->markAsRead();
            return view('pages.user.notifications' , [
                'notifications' => $notifications ,
                ]);
        }
        $notifications = null;
        return view('pages.user.notifications' , [
            'notifications' => $notifications
            ]);
    }
}
