<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function talent()
    {
        $designers = User::where('role', 'designer')
            ->withCount('shots')
            ->latest()
            ->paginate(12);

        return view('talent.index', compact('designers'));
    }
    
    public function follow($id)
    {
        $userToFollow = User::findOrFail($id);
        $user = auth()->user();

        if ($user->id ==    $userToFollow->id) {
            return response()->json([
                'error' => 'Tidak bisa  follow diri sendiri'
            ], 400);
        }

        $alreadyFollowed = $user->following()
            ->where('following_id', $id)
            ->exists();

        if ($alreadyFollowed) {
            $user->following()->detach($id);
        } else {
            $user->following()->attach($id);
        }

        return response()->json([
            'following' => !$alreadyFollowed
        ]);
    }
}