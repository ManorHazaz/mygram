<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');

    }

    public function index(User $user)
    {
        $posts = $user->posts()->latest()->with('user')->paginate(6);

        return view('pages.user.index',[
            'user' => $user,
            'posts' =>$posts,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('authorized', $user);

        return view('pages.user.edit',[
            'user' => $user,
        ]);
    }

    public function update(User $user)
    {
        $this->authorize('authorized', $user);
        
        $data = request()->validate([
            'fullname' => 'required|max:255',
            'password' => 'nullable|confirmed',          
        ]);

        if( $data['password'] == null )
        {
            $user->update([
                'fullname' => $data['fullname'],
            ]);

            return back();
        }

        $user->update([
            'fullname' => $data['fullname'],
            'password' => Hash::make($data['password']),
        ]);

        return back();
    }

    public function indexPosts(User $user)
    {
        return view('pages.user.indexPosts',[
            'user' => $user,
        ]);
    }

    public function destroy( User $user )
    {
        $this->authorize('delete', $user);
        $username = $user->username;

        File::deleteDirectory(public_path('storage/uploads/'. $username));
        File::deleteDirectory(public_path('storage/profilePictures/'. $username));

        $user->delete();
        auth()->logout();
        return redirect()->route('home');
    }
}
