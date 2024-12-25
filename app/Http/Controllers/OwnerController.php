<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cafe;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ClaimedReward;

class OwnerController extends Controller
{
    public function index()
    {
        $owner = auth()->user();
        // Retrieve all cafes or filter as needed
        $cafe = Cafe::where('user_id', $owner->user_id)->first();
    
        // Assuming the logged-in owner is associated with a specific cafe
        $cafeId = $owner->cafe_id; // Ensure the owner has a `cafe_id`
    
        // Today's Reservations
        $reservationsToday = Reservation::where('cafe_id', $cafeId)
            ->whereDate('created_at', today())
            ->count();
    
        // Get today's date
        $today = Carbon::today();
    
        // Count the number of feedbacks (reviews) for today
        $newReviews = Feedback::where('cafe_id', $cafeId)
            ->whereDate('created_at', $today)
            ->count();
    
        // Active Reward Members - Users who have claimed rewards for this cafe
        $activeMembers = ClaimedReward::where('cafe_id', $cafeId)
            ->distinct('user_id') // Count unique users only
            ->count('user_id');
    
        // Average Cafe Rating for this cafe
        $averageRating = Feedback::where('cafe_id', $cafeId)
            ->avg('rating');
    
        // Total Claimed Rewards for this cafe
        $claimedRewardCount = ClaimedReward::where('cafe_id', $cafeId)->count();
    
        // Render the owner's dashboard view with the data
        return view('owners.index', compact(
            'reservationsToday', 
            'newReviews', 
            'activeMembers', 
            'averageRating',
            'claimedRewardCount',
            'cafe'
        ));
    }
}
