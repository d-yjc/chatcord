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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('tier')->comment('basic, standard, premium');
            $table->string('status')->comment('active, cancelled');
            $table->integer('duration')->unsigned()->comment('Unit in month(s).');
            //Set to unique, as this is one-to-ONE, not one-to-MANY.
            $table->bigInteger('chat_user_id')->unsigned()->unique();
            $table->foreign('chat_user_id')->references('id')->on('chat_users')
                ->onDelete('cascade')->onUpdate('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
