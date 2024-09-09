<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;
use App\Models\ClaimedReward;

class RewardClaimController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards.index', compact('rewards'));
    }

    public function claim(Request $request, Reward $reward)
    {
        $user = auth()->user();
        
        // Check if user has enough points
        if ($user->points < $reward->points_required) {
            return back()->with('message', 'Not enough points to claim this reward.');
        }

        // Create claimed reward
        $claimedReward = ClaimedReward::create([
            'user_id' => $user->user_id,
            'reward_id' => $reward->reward_id,
            'claimed_at' => now(),
        ]);

        // Deduct points from user
        $user->points -= $reward->points_required;
        $user->save();

        return back()->with('message', 'Reward claimed successfully!');
    }

    public function userRewards()
    {
        $user = auth()->user();
        $points = $user->points;
        $claimedRewards = $user->claimedRewards()
            ->with('reward')
            ->get();
    
        return view('rewards.user-rewards', compact('points', 'claimedRewards'));
    }
}
