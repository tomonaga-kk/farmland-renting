<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        // 操作用ユーザ作成
        $this->call([UsersTableSeeder::class]);
        
        // その他ユーザを大量に作成
        User::factory()->count(18)->create();
        
        // 操作用ユーザに投稿を作成する
        $this->call([PostsTableSeeder::class]);
    }
}
