<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Category;
use App\Models\Bookmark;
use App\Models\Follower;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(100)->create();

        Post::factory(500)->create();

        Comment::factory(1000)->create();

        Like::factory(2000)->create();

        Category::factory(20)->create();

        Bookmark::factory(500)->create();

        Follower::factory(300)->create();
    }
}