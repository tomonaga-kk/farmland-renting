<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // ユーザ１：管理者
        DB::table('users')->insert([
            'name'              => 'testuser1',
            'email'             => 'testuser1@test.test',
            'password'          => Hash::make('testuser1'),
            'user_type'         => 0,
            'one_word_message'  => '農業を30年やってます！',
            'created_at'        => date('Y-m-d H:i:s'),
        ]);
        
        // ユーザ２：一般
        DB::table('users')->insert([
            'name'              => 'testuser2',
            'email'             => 'testuser2@test.test',
            'password'          => Hash::make('testuser2'),
            'user_type'         => 1,
            'one_word_message'  => '山を持ってます！',
            'created_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}
