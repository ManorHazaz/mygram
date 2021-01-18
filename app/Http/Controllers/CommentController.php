<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('authorized', auth()->user());
        
        $data = request()->validate([
            'body' => 'required|max:255',         
        ]);
        
        if( auth()->user() != $post->user )
        {
            $oldNotification = ($post->user->notifications()->where('type' , 'App\Notifications\CommentNotification')->where('data', ['post_id' => $post->id])->where('user_id' , auth()->user()->id)->first());
            if( $oldNotification == null )
            {
                $post->user->notify(new CommentNotification(auth()->user(),$post));
            }
            
        }

         $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
        ]);

        return back();
    }

    public function destroy( Comment $comment )
    {
        $postId = $comment->post_id;
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->route('post.show', $postId);
    }
}
