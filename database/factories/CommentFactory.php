<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
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
            'user_id' => User::all()->random()->id,
            'post_id' => Post::all()->random()->id,
            'content' => $this->faker->paragraph(),
            'parent_id' => null,
        ];
    }

    public function withParent(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Comment::all()->random()->id,
            ];
        });
    }
}
