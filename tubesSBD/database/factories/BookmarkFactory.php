<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookmarkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 100),
            'post_id' => rand(1, 500),
        ];
    }
}