<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(640, 480, 'design'),
            'views' => fake()->numberBetween(0, 10000),
        ];
    }
}