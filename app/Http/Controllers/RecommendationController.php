<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RecommendationController extends Controller
{

    public function getRecommendations(Request $request)
    {
        $userId = auth()->id();
        
        if (!$userId) {
            return redirect()->route('login')->with('error', 'You must be logged in to view recommendations.');
        }
    
        $top_n = $request->query('top_n', 5);
    
        // Make the GET request to the Flask API for personalized recommendations
        $response = Http::get('http://127.0.0.1:5000/recommend', [
            'user_id' => $userId,
            'top_n' => $top_n,
        ]);
    
        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch recommendations'], 500);
        }
    
        $data = $response->json();
        $recommendations = $data['recommendations'] ?? [];
    
        // If there are no personalized recommendations, fetch fallback recommendations
        if (empty($recommendations)) {
            $recommendations = $this->fallbackRecommendations($top_n);
        }
    
        // Fetch cafe details based on the recommendations but only include "Approved" cafes
        $cafeDetails = Cafe::whereIn('cafe_id', collect($recommendations)->pluck('cafe_id'))
            ->where('status', 'Approved')  // Ensure only "Approved" cafes are fetched
            ->get();
    
        // Combine recommendation ratings with cafe details
        $recommendationsWithDetails = collect($recommendations)->map(function ($rec) use ($cafeDetails) {
            $cafe = $cafeDetails->firstWhere('cafe_id', $rec['cafe_id']);
            
            // If the cafe is "Approved", include it in recommendations
            if ($cafe) {
                return [
                    'cafe_id' => $rec['cafe_id'],
                    'predicted_rating' => $rec['predicted_rating'] ?? null,
                    'cafe_name' => $cafe->cafe_name ?? 'Unknown Cafe',
                    'logo' => $cafe->logo ?? null,
                ];
            }
            return null; // Exclude "Pending" or non-approved cafes
        })->filter(); // Remove any null values (non-approved cafes)
    
        // Pass the processed recommendations to the view
        return view('recommendations.recommendations', ['recommendations' => $recommendationsWithDetails]);
    }
    
    private function fallbackRecommendations($top_n)
    {
        // Fetch top-rated "Approved" cafes as fallback recommendations
        $fallbackCafes = Cafe::where('status', 'Approved')  // Only consider "Approved" cafes
            ->withAvg('feedbacks', 'rating')
            ->orderByDesc('feedbacks_avg_rating')
            ->take($top_n)
            ->get();
    
        return $fallbackCafes->map(function ($cafe) {
            return [
                'cafe_id' => $cafe->cafe_id,
                'predicted_rating' => round($cafe->feedbacks_avg_rating, 2),
                'cafe_name' => $cafe->cafe_name,
                'logo' => $cafe->logo,
            ];
        });
    }
    
    
}

