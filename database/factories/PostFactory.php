<?php

namespace Database\Factories;
use App\Models\ChatUser;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{   
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'topic' => fake()->sentence(4),
            'body' => fake()->sentence(6),
            'chat_user_id' => ChatUser::factory()
        ];  
    }
    
        public function configure()
        {           
            return $this->afterMaking(function (Post $post) {
                $post->chat_user_id = ChatUser::inRandomOrder()->first()->id;
            });
        }
    }
    