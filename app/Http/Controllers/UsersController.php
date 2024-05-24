<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Post;

class UsersController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $users = User::orderBy('id', 'asc')->paginate(10);
        
    
        return view('users.index', [
            'users' => $users,
        ]);
    }

    // public function create(){}
    // public function store(Request $request){}

    public function show(string $id)
    {
        // ユーザデータ取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // お気に入り投稿データ取得
        $likePostsIds = $user->likePosts()->pluck('posts.id')->toArray();
        $myPosts = $user->posts()->orderBy('id', 'asc')->paginate(5);
        
        return view('users.show', [
            'user' => $user,
            'posts'=> $myPosts,
        ]);
    }
    
    public function show_likes(string $id){
        // ユーザデータ取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // お気に入り投稿データ取得
        $likePostsIds = $user->likePosts()->pluck('posts.id')->toArray();
        $likePosts = Post::whereIn('id', $likePostsIds)->paginate(5);
        
        return view('users.show', [
            'user' => $user,
            'posts'=> $likePosts,
        ]);
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        
        // 他人のユーザ情報は編集させない（管理者はOK！）
        if(Auth::user()->id != $user->id && Auth::user()->user_type != 0){
            return back();
        }
        
        
        
        return view('users.edit', [
            'user'  => $user,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        // 他人のユーザ情報は編集させない（管理者はOK！）
        if(Auth::user()->id != $user->id && Auth::user()->user_type != 0){
            return back();
        }
        
        // バリデーション
        $request->validate([
            'name'              => 'required|string|max:30',
            'email'             => 'required|email',
            'one_word_message'  => 'string|max:300',
        ]);
        
        
        // DB更新
        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->one_word_message = $request->one_word_message;
        $user->save();
        
        
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        
        // 他人のユーザ情報は編集させない（管理者はOK！）
        if(Auth::user()->id != $user->id && Auth::user()->user_type != 0){
            return back();
        }
        
        $user->delete();
        return redirect('/');
    }
}
