<?php

namespace Database\Factories;
use App\Models\ChatUser;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [                    
            'body' => fake()->sentence(6),   
            'chat_user_id' =>ChatUser::factory(),
            'post_id' => Post::factory()
        ];
    }

    public function configure()         
    {           
        return $this->afterMaking(function (Comment $comment) {
            $comment->chat_user_id = ChatUser::inRandomOrder()->first()->id;
            $comment->post_id = Post::inRandomOrder()->first()->id;
        });
    }
    
}
    