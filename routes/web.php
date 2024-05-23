<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;




Auth::routes();



Route::get('/',     [PostsController::class, 'index']);
Route::get('/home', [PostsController::class, 'index'])->name('home');


Route::middleware('auth')->group(function(){
    Route::resource('users', UsersController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    Route::resource('posts', PostsController::class);
});