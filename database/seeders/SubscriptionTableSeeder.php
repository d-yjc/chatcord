<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChatUser;
use App\Models\Subscription;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Fetch users without subscriptions and shuffle them in one step
       $shuffledUsers = ChatUser::doesntHave('subscription')->get()->shuffle();

       // Assign subscriptions to all shuffled users
       $shuffledUsers->each(function ($user) {
           Subscription::factory()->create([
               'chat_user_id' => $user->id, // Assign to this user
           ]);
       });
    }
}
