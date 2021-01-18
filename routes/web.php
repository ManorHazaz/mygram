<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExploreContorller;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\notificatinsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Notifications\likeNotification;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard' , [DashboardController::class, 'index']) -> name('dashboard') ;
Route::get('/explore' , [ExploreContorller::class, 'index']) -> name('explore') ;
Route::post('/search' , [DashboardController::class, 'search']) -> name('dashboard.search') ;

Route::get('/register' , [RegisterController::class, 'index']) -> name('register') ;
Route::post('/register' , [RegisterController::class, 'store']) ;

Route::get('/login' , [LoginController::class, 'index']) -> name('login') ;
Route::post('/login' , [LoginController::class, 'store']) ;

Route::post('/logout' , [LogoutController::class, 'store']) -> name('logout');

Route::get('/user/{user:username}/index' , [UserController::class, 'index']) -> name('user.index');
Route::get('/user/{user:username}/index/posts' , [UserController::class, 'indexPosts']) -> name('user.index.posts') ;
Route::get('/user/{user:username}/notifications' , [NotificatinsController::class, 'index']) -> name('user.notifications') ;
Route::get('/user/{user:username}/edit' , [UserController::class, 'edit']) -> name('user.edit');
Route::patch('/user/{user:username}/edit' , [UserController::class, 'update']) ->name('user.update') ;
Route::delete('/user/{user:username}/delete' , [UserController::class, 'destroy']) -> name('user.destroy');

Route::get('/profile/{user}/edit' , [ProfileController::class, 'edit']) -> name('profile.edit');
Route::patch('/profile/{profile}/edit' , [ProfileController::class, 'update']) ->name('profile.update') ;

Route::get('/post/create' , [PostController::class, 'create']) -> name('post.create') ;
Route::get('/post/{post}/index' , [PostController::class, 'index']) -> name('post.show') ;
Route::delete('/post/{post}/delete' , [PostController::class, 'destroy']) -> name('post.destroy');
Route::post('/post/create' , [PostController::class, 'store']);

Route::post('/post/{post}/like' , [LikeController::class, 'store']) -> name('like.post') ;
Route::delete('/post/{post}/like' , [LikeController::class, 'destroy']) -> name('like.post') ;

Route::post('/post/{post}/comment' , [CommentController::class, 'store']) -> name('comment.post') ;
Route::delete('/post/{comment}/comment/delete' , [CommentController::class, 'destroy']) -> name('post.comment.destroy');

Route::post('follow/{user:username}' , [FollowController::class, 'store']) ->name('follow.user');

Route::get('/', function () {
    return view('pages.auth.login');
}) -> name('home');
