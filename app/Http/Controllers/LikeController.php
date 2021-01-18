<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\likeNotification;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('authorized', auth()->user());
        
        if($post->likedBy($request->user()))
        {
            return response(null, 409);
        }

        if( auth()->user() != $post->user )
        {
            $oldNotification = ($post->user->notifications->where('type' , 'App\Notifications\likeNotification')->where('data', ['post_id' => $post->id])->where('user_id' , auth()->user()->id)->first());
            if( $oldNotification == null )
            {
                $post->user->notify(new likeNotification(auth()->user(),$post));
            }
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();
    }
}
