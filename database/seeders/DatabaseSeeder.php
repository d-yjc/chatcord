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
                    ->hasPosts(rand(1,5))
                    ->hasComments(rand(1, 5))       
                    ->hasSubscription(1)
                    ->count(50)
                    ->create();         
                }
            }   
