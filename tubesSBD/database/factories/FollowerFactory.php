<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FollowerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'follower_id' => rand(1, 100),
            'following_id' => rand(1, 100),
        ];
    }
}