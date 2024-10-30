<?php

namespace Database\Seeders;
use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $testSubscription = new Subscription;
        $testSubscription->tier = 'premium';
        $testSubscription->status = 'active';
        $testSubscription->duration = 11;
        $testSubscription->chat_user_id = 1;
        $testSubscription->save();
        
        Subscription::factory()->count(50)->create();
    }
}
