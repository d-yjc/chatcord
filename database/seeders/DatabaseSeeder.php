<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChatUser;
use App\Models\Post;
use App\Models\Comment;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        ChatUser::factory()
        ->count(50)
        ->has(Post::factory()->count(rand(1, 7), 'posts'))
        ->has(Comment::factory()->count(rand(1,10), 'comments'))
        ->hasSubscription(1)
        ->create();         
    }
}
