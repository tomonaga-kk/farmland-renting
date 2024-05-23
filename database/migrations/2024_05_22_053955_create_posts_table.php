<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('place')->nullable();
            $table->integer('size_of_area')->nullable();
            $table->integer('price_by_month')->nullable();
            // $table->double('price_by_month', 10,2)->nullable();
            $table->text('one_word_message')->nullable();
            $table->string('img_name')->nullable();
            $table->timestamps();
            
            // 外部キー制約：user_id = usersテーブルのidカラム
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
