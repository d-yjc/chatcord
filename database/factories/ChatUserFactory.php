<?php

namespace Database\Factories;
use App\Models\ChatUser;
use App\Models\Group;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;
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
            'email' => fake()->unique()->email(),
            'password' => fake()->password(),
            'remember_token' => Str::random(10),
        ];
    }
    
    public function hasRoles($count = 1)
    {
        return $this->afterCreating(function (ChatUser $user) use ($count) {
            $roles = Role::all();

            $roleIds = $roles->random($count)->pluck('id')->toArray();
            $user->roles()->attach($roleIds);
        });
    }
}
