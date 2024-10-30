<?php

namespace Database\Seeders;

use App\Models\ChatUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatUserSeeder extends Seeder
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
        $testUser->password = "password";
        $testUser->save();

        ChatUser::factory()->count(50)->create();
    }
}
