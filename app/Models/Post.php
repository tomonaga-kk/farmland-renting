<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'place',
        'size_of_area',
        'price_by_month',
        'one_word_message',
        'img_name',
    ];

    protected $hidden = [
    ];

    protected $casts = [
    ];
    
    
    
    // 紐づくレコード数を取得するメソッド
    public function loadRelationshipCounts(){
        $this->loadCount(['user', 'likeusers']);
        // $this->loadCount(['メソッド1', 'メソッド2']);  // リレーションのメソッド名を記載する
    }
    
    
    // 1対多のリレーション
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
    // 多対多のリレーション
    public function likeUsers(){
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps();
        // $this->belongsToMany(関係先モデル名::class, '中間テーブル名', '中間テーブルの自分のカラム', '中間テーブルの関係先カラム'
    }
    
    // likeするメソッド
    public function like(){
        // like済みかどうか確認：　like済み⇒true, 未like⇒false
        $isLiked = $this->isLiked();
        
        // 未like(=false)ならattachする
        if($isLiked == false){
            $this->likeUsers()->attach(Auth::user()->id);
            return true;
        }
        
        return false;
    }
    
    
    // like解除するメソッド
    public function unlike(){
        $isLiked = $this->isLiked();
        
        // like済み（=true）ならdetachする
        if($isLiked == true){
            $this->likeUsers()->detach(Auth::user()->id);
            return true;
        }
        
        return false;
    }
    
    
    public function isLiked(){
        return $this->likeUsers()->where('user_id', Auth::user()->id)->exists();
    } 
}
