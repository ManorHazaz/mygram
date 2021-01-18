<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('authorized', auth()->user());
        
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->paginate(5);
        return view('pages.dashboard' , [
            'posts' => $posts
            ]);

    }

    public function search(Request $request)
    {
        $data = request()->validate([
            'search' => 'required',
        ]);

        $user = $data['search'];

        return redirect( route('user.index' , $user) );
    }
}
