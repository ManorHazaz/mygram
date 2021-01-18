<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($user){
            $user->profile()->create([
                'title' => $user->username
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function receivedLikes()
    {
        return $this->hasManyThrough( Like::class, Post::class );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function receivedComments()
    {
        return $this->hasManyThrough( Comment::class, Post::class );
    }

    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function getUserById($id)
    {
        $user =  User::where('id',$id) -> first();
        return $user;
    }

    public function isFollowing($profile)
    {
        return (DB::table('profile_user')->where('user_id', auth()->user()->id)->where('profile_id', $profile->id));
    }
}
