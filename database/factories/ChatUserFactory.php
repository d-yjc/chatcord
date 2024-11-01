<?php

namespace Database\Factories;
use App\Models\ChatUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatUser>
 */
class ChatUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->email(),
            'password' => fake()->password()
        ];
    }
    
}
