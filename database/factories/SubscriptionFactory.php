<?php

namespace Database\Factories;

use App\Models\ChatUser;
use App\Models\Subscription;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $faker = Faker::create();                    
        return [
            'tier' => fake()->randomElement(['basic', 'standard', 'premium']),
            'status' => fake()->randomElement(['active', 'cancelled']),
            'duration' => fake()->numberBetween(1,12),
        ];
    }
}
