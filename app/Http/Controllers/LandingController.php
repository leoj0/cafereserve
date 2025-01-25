<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use App\Models\Feedback;

class LandingController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Get the authenticated user ID (if logged in)
        
        // Fetch all cafes for general listing
        $cafes = Cafe::all(); 
        
        // Fetch the latest feedbacks
        $feedbacks = Feedback::latest()->take(4)->get();
        
        // Fetch pending cafes for the admin section
        $pendingCafes = Cafe::where('status', 'Pending')->paginate(5);
        
        // Fetch personalized recommendations
        $recommendationsWithDetails = Cafe::getRecommendations($userId, 5); // Limit to 4 recommendations
    
        return view('landing.index', compact('cafes', 'feedbacks', 'pendingCafes', 'recommendationsWithDetails'));
    }

    
}
