<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\UserCommentController;
use App\Http\Controllers\UserLikeController;
use App\Http\Controllers\UserPostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Index/Index');
});
// user registration resourceful route
Route::resource('user-account', UserAccountController::class)->only(['create','store']);
// user authentication  routes

Route::get('login',[AuthController::class,'create'])->name('login');
Route::post('login',[AuthController::class,'store'])->name('login.store');
Route::get('logout',[AuthController::class,'destroy'])->name('logout');

// for displaying all of the posts and a particular post
Route::resource('post',PostsController::class)->only(['index','show']);

Route::resource('post.comment',UserCommentController::class)->middleware('auth')->only('store');
Route::resource('post.like',UserLikeController::class)->middleware('auth')->only(['store','destroy']);
// only for authenticated user
// prefixi all the url with user/ and named routes with user with a dot notation
Route::prefix('user')->name('user.')->middleware('auth')->group(function (){
    Route::resource('post',UserPostsController::class);
    Route::resource('comment',UserCommentController::class)->except(['create','store','show']);
    Route::resource('like',UserLikeController::class)->only(['index']);
    });