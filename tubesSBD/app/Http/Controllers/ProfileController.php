<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts;

        return view('profile.show', compact('user', 'posts'));
    }
}