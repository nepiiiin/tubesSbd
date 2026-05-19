<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function follow(User $user)
    {
        $follower = auth()->user();
        
        if (!$follower) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
        
        if ($follower->id === $user->id) {
            return response()->json(['success' => false, 'message' => 'Cannot follow yourself'], 400);
        }

        $existing = DB::table('follows')
            ->where('follower_id', $follower->id)
            ->where('following_id', $user->id)
            ->first();

        if ($existing) {
            DB::table('follows')->where('id', $existing->id)->delete();
            return response()->json(['following' => false]);
        }

        DB::table('follows')->insert([
            'follower_id' => $follower->id,
            'following_id' => $user->id,
            'created_at' => now()
        ]);
        
        return response()->json(['following' => true]);
    }
}