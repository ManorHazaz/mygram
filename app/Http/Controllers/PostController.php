<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        return view('pages.posts.index',[
            'post' => $post,
        ]);
    }

    public function create(Post $post)
    {
        return view('pages.posts.create',[
            'post' => $post,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('authorized', $request->user());

        $data = request()->validate([
            'description' => 'max:255|required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',            
        ]);
        

        $username = $request->user()->username;

        $imagePath = 'storage/' . $request->file('image')->store('uploads/' . $username, 'public');

        $image = Image::make(public_path($imagePath))->fit( 1200,1200 );
        $image->orientate();
        $image->save();

        $request->user()->posts()->create([
            'description' => $data['description'],
            'image' => $imagePath,
        ]);

        return redirect( route('dashboard') );
    }
    

    public function destroy( Post $post )
    {
        $this->authorize('delete', $post);
        // unlink($post->image);
        $notifications = $post->user->notifications->where('data', ['post_id' => $post->id]);
        if(!$notifications->isEmpty())
        {
            $notifications->each->delete();
        }
        $post->delete();
        return redirect()->route('user.index', $post->user);
    }
}
