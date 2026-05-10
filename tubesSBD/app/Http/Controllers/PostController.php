<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'likes')->latest()->get();

        return view('welcome', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create([
            'user_id' => 1,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return redirect('/');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}