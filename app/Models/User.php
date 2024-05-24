<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        // 'user_type',
        'one_word_message',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    // 紐づくレコード数を取得するメソッド
    public function loadRelationshipCounts(){
        $this->loadCount(['posts', 'likeposts']);
        // $this->loadCount(['メソッド1', 'メソッド2']);  // リレーションのメソッド名を記載する
    }
    
    // 1対多のリレーション
    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    // 多対多のリレーション
    public function likePosts(){
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
        // $this->belongsToMany(関係先モデル名::class, '中間テーブル名', '中間テーブルの自分のカラム', '中間テーブルの関係先カラム'
    }
}
