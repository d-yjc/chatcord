<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChatUser;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Subscription;
use App\Models\Group;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleTableSeeder::class,
            ChatUserTableSeeder::class,
            PostTableSeeder::class,
            CommentTableSeeder::class,
        ]);
    }
}
