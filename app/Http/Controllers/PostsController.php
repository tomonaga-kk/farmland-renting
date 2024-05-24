<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\Rules\File;

use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        
        // 関係するモデルの件数をロード
        // $posts->loadRelationshipCounts();  // ⇐indexアクションではうまく動かせなかった。。
        
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title'             => 'required|string|max:100',
            'place'             => 'required|string',
            'size_of_area'      => 'required|integer',
            'price_by_month'    => 'required|integer',
            'one_word_message'  => 'required|string|max:300',
            'img_name'          => File::types(['jpg','png','jpeg'])->max('1024kb'),
        ]);
        
        // 画像を格納　※格納先：/storage/app/public/任意のフォルダ名
        $dir = 'post_img';  // 画像格納フォルダ名
        $path = $request->file('img_name')?->store('public/' . $dir);
        
        // パスの書き替え（画像呼び出す時のためにパスを書き換えておく）
        $path = str_replace('public/', 'storage/', $path);
        
        
        // DBに保存
        Post::create([
            'user_id'           => Auth::user()->id,
            'title'             => $request->title,
            'place'             => $request->place,
            'size_of_area'      => $request->size_of_area,
            'price_by_month'    => $request->price_by_month,
            'one_word_message'  => $request->one_word_message,
            'img_name'          => $path,
        ]);
        
        return redirect(route('posts.index'));
    }


    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        
        return view('posts.show', [
            'post'  => $post    
        ]);
    }


    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        
        // 他人の投稿は編集させない（管理者を除く）
        if(Auth::user()->id != $post->user_id && Auth::user()->user_type != 0){
            return back();
        }
        
        return view('posts.edit', [
            'post'  => $post
        ]);
    }


    public function update(Request $request, string $id)
    {
        // バリデーション
        $request->validate([
            'title'             => 'required|string|max:100',
            'place'             => 'required|string',
            'size_of_area'      => 'required|integer',
            'price_by_month'    => 'required|integer',
            'one_word_message'  => 'required|string|max:300',
            'img_name'          => File::types(['jpg','png','jpeg'])->max('1024kb'),
        ]);
        
        $post = Post::findOrFail($id);
        
        // 他人の投稿は編集させない（管理者を除く）
        if(Auth::user()->id != $post->user_id && Auth::user()->user_type != 0){
            return back();
        }

        if($request->file('img_name') != null){
            
            // 画像を格納　※格納先：/storage/app/public/任意のフォルダ名
            $dir = 'post_img';  // 画像格納フォルダ名
            $path = $request->file('img_name')?->store('public/' . $dir);
            
            // パスの書き替え（画像呼び出す時のためにパスを書き換えておく）
            $path = str_replace('public/', 'storage/', $path);
        }else{
            // 画像が変更されていなければ元の画像を再度格納
            $path = $post->img_name;
        }
        
        
        $post->update([
            'user_id'           => Auth::user()->id,
            'title'             => $request->title,
            'place'             => $request->place,
            'size_of_area'      => $request->size_of_area,
            'price_by_month'    => $request->price_by_month,
            'one_word_message'  => $request->one_word_message,
            'img_name'          => $path,
        ]);
        
        return redirect()->route('posts.show', $post->id);
    }


    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        
        // 他人の投稿は編集させない（管理者を除く）
        if(Auth::user()->id != $post->user_id && Auth::user()->user_type != 0){
            return back();
        }
        
        $post->delete();
        return redirect()->route('users.show', $post->user_id);
    }
}
