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
        'title' => 'required',
        'image' => 'required|image',
    ]);

    $imagePath = $request->file('image')->store('shots', 'public');

    Shot::create([
        'user_id' => auth()->id(),

        'title' => $request->title,

        'description' => $request->description,

        'image_url' => $imagePath,

        'title' => $request->title,
    ]);

    return redirect('/profile/' . auth()->user()->username);
}
public function show(Shot $shot)
{
    return view('shots.show', compact('shot'));
}
}