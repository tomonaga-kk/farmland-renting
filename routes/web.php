<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LikesController;



Auth::routes();



Route::get('/',     [PostsController::class, 'index']);
Route::get('/home', [PostsController::class, 'index'])->name('home');


Route::middleware('auth')->group(function(){
    Route::resource('users', UsersController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::resource('posts', PostsController::class);
    
    Route::prefix('post/{id}')->group(function(){
        
        // お気に入り機能
        Route::post  ('like',     [LikesController::class, 'store'])    ->name('likes.store');
        Route::delete('unlike',   [LikesController::class, 'destroy'])  ->name('likes.destroy');
        Route::get('show_likes', [UsersController::class, 'show_likes'])->name('users.show_likes');
    });
});