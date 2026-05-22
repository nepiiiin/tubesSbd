<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shot;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
{
    $request->validate([
    'title' => ['required', 'string', 'max:255'],
    'description' => ['nullable', 'string'],
    'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240'],
]);

    $imagePath = $request->file('image')->store('shots', 'public');

    Shot::create([
        'user_id' => auth()->id(),

        'title' => $request->title,

        'description' => $request->description,

        'image_url' => $imagePath,
    ]);

    return redirect('/profile/' . auth()->user()->username);
}
public function show(Shot $shot)
{
    return view('shots.show', compact('shot'));
}
}