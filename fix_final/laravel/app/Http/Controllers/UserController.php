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
    $targetUser = User::findOrFail($id);

    if (auth()->id() === $targetUser->id) {
        return response()->json([
            'message' => 'Tidak bisa follow diri sendiri.'
        ], 403);
    }

    $alreadyFollowing = auth()->user()
        ->following()
        ->where('following_id', $targetUser->id)
        ->exists();

    if ($alreadyFollowing) {
        auth()->user()->following()->detach($targetUser->id);
    } else {
        auth()->user()->following()->attach($targetUser->id);
    }

    return response()->json([
        'following' => !$alreadyFollowing,
        'followers_count' => $targetUser->followers()->count(),
        'following_count' => auth()->user()->following()->count(),
    ]);
}
}