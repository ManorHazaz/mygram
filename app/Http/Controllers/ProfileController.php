<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class ProfileController extends Controller
{

    public function update(Profile $profile ,Request $request)
    {
        $this->authorize('authorized', $profile->user);

        $data = request()->validate([
            'title' => 'max:40',
            'description' => 'max:255|nullable',
            'url' => 'url|nullable',            
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',           
        ]);

        if(isset($data['image']))
        {
            $username = $profile->user->username;
            
            $imagePath = 'storage/' . $request->file('image')->store('profilePictures/' . $username, 'public');

            $image = Image::make(public_path($imagePath))->fit( 1200,1200 );
            $image->orientate();
            $image->save();
        }
        else
        {
            $imagePath = null;
        }

        $profile->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $data['url'],
            'image' => $imagePath,
        ]);

        return back();
    }

    public function edit(User $user)
    {
        $this->authorize('authorized', $user);

        return view('pages.profile.edit',[
            'user' => $user,
        ]);
    }
}
