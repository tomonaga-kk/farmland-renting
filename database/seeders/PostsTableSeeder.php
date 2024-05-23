<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // 追記
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ja_JP');
        
        // 管理者ユーザtestuser1の投稿作成
        for($i = 1; $i <= 10; $i++){
            DB::table('posts')->insert([
                'user_id'           => 1,
                'title'             => $faker->realText(10),
                'place'             => substr($faker->address, 8),
                'size_of_area'      => rand(1,9999),
                'price_by_month'    => rand(1,100000),
                'one_word_message'  => $faker->realText(100),
                'img_name'          => 'sample_images/img' . rand(1,3) . '_640x360.jpg',
                'created_at'        => date('Y-m-d H:i:s'),
            ]);
        }
        
        // 一般ユーザtestuser2の投稿作成
        for($i = 1; $i <= 10; $i++){
            DB::table('posts')->insert([
                'user_id'           => 2,
                'title'             => $faker->realText(10),
                'place'             => substr($faker->address, 8),
                'size_of_area'      => rand(1,9999),
                'price_by_month'    => rand(1,100000),
                'one_word_message'  => $faker->realText(100),
                'img_name'          => 'sample_images/img' . rand(1,3) . '_640x360.jpg',
                'created_at'        => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
