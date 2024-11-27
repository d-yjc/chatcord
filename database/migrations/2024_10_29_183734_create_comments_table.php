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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('body');
            
            $table->bigInteger('chat_user_id')->unsigned();
            $table->foreign('chat_user_id')->references('id')->on('chat_users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
