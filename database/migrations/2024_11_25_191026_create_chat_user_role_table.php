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
        Schema::create('chat_user_role', function (Blueprint $table) {
            $table->primary(['chat_user_id', 'role_id']);
            $table->unsignedBigInteger('chat_user_id');
            $table->unsignedBigInteger('role_id');                    
            $table->timestamps();

            $table->foreign('chat_user_id')->references('id')->on('chat_users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_user_role');
    }
};
