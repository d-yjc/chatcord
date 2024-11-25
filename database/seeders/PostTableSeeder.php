<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.  
     */
    public function run(): void
    {   
        //
        $testPost = new Post;
        $testPost->topic = "How do I center a div within a div?";
        $testPost->body = "Idk how to do it--any suggestions?";
        $testPost->chat_user_id = 1;
        $testPost->save();

        Post::factory()->count(20)->create();
    }
}
