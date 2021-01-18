<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        $this->authorize('authorized', auth()->user());

        auth()->user()->following()->toggle($user->profile);
        if( auth()->user()->isFollowing($user->profile)->count())
        {
            $user->notify(new FollowNotification(auth()->user()));
        }
        
        return back();
    }
}
