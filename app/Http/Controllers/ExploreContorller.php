<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExploreContorller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->authorize('authorized', auth()->user());
        
        $posts = Post::paginate(5);
        
        return view('pages.explore', [
            'posts' => $posts
            ]);
    }
}
