<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function recommendCafes()
    {
        $user = Auth::user();
    
        // Set userTags and userRatedCafes to default if user is not authenticated or has no rated cafes
        $userTags = $user ? explode(',', $user->user_tags) : [];
        $userRatedCafes = $user ? $user->ratedCafes ?? collect() : collect(); // Use an empty collection if null
    
        // Fetch cafes to recommend and calculate similarity scores
        $cafes = Cafe::all();
        $recommendations = [];
    
        foreach ($cafes as $cafe) {
            $score = $this->calculateSimilarity($userRatedCafes, $cafe, $userTags);
            if ($score > 0) { // Only add cafes with a non-zero score
                $recommendations[] = [
                    'cafe' => $cafe,
                    'score' => $score,
                ];
            }
        }
    
        // Sort recommendations by score, highest first
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);
    
        // Pass to view
        return view('recommendations.recommendations', ['recommendations' => $recommendations]);
    }

    private function calculateSimilarity($userRatedCafes, $cafe, $userTags)
    {
        $score = 0;
    
        if ($userRatedCafes->isEmpty()) {
            // User hasn't interacted with any cafes, use tags only for recommendations
            $cafeTags = explode(',', $cafe->cafe_tags);
            $matchingTags = array_intersect($userTags, $cafeTags);
            $score += count($matchingTags) * 2; // Higher weight for matching user tags
    
            return $score; // Return early since we only want tag-based score here
        }
    
        // If the user has interacted with cafes, calculate similarity based on history and tags
        foreach ($userRatedCafes as $userCafe) {
            // Increase score if location matches
            if ($userCafe->location === $cafe->location) {
                $score += 3; // Higher weight for location match
            }
    
            // Calculate tag similarity with user's preferred tags
            $cafeTags = explode(',', $cafe->cafe_tags);
            $matchingTags = array_intersect($userTags, $cafeTags);
            $score += count($matchingTags) * 2; // Higher weight for matching user tags
    
            // Calculate tag similarity with previously liked cafes
            $userCafeTags = explode(',', $userCafe->cafe_tags);
            $cafeMatchingTags = array_intersect($userCafeTags, $cafeTags);
            $score += count($cafeMatchingTags);
        }
    
        // Factor in overall rating (e.g., prioritize cafes with higher average ratings)
        $averageRating = Feedback::where('cafe_id', $cafe->cafe_id)->avg('rating');
        $score += $averageRating / 5; // Normalize rating to add a fractional score
    
        return $score;
    }
    
}

