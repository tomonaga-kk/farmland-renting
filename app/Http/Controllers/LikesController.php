<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class LikesController extends Controller
{
    public function store(string $post_id){
        $post = Post::findOrFail($post_id);
        $post->like();
        
        return back();
    }
    
    public function destroy(string $post_id){
        $post = Post::findOrFail($post_id);
        $post->unlike();
        
        return back();
    }
}
