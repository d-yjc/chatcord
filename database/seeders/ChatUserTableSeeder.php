<?php

namespace Database\Seeders;

use App\Models\ChatUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //      
        $testUser = new ChatUser;
        $testUser->username = "Adam";
        $testUser->email = "smith@domain.com";
        $testUser->password = bcrypt("password");
        $testUser->save();

        // Create users with factory relationships
        ChatUser::factory()
            ->count(10) 
            ->hasRoles(rand(1, 2))
            ->hasPosts(rand(1, 5)) 
            ->hasComments(rand(1, 5)) 
            ->create();
    }
}
        