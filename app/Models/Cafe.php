<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cafe extends Model
{
    use HasFactory;

    protected $primaryKey = 'cafe_id';

    protected $fillable = [
        'cafe_name',
        'phone_number',
        'email',
        'cafe_tags',
        'location',
        'description',
        'opening_time',
        'closing_time',
        'logo',
        'user_id',
        'ssm_certificate', 
        'business_license',
    ];
    
    public function scopeFilter($query, array $filters)
    {
        // Filter by tag if provided
        if ($filters['tag'] ?? false) {
            $query->where('cafe_tags', 'like', '%' . $filters['tag'] . '%');
        }
    
        // Filter by search terms (name or tags) if provided
        if ($filters['search'] ?? false) {
            $query->where(function ($q) use ($filters) {
                $q->where('cafe_name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('cafe_tags', 'like', '%' . $filters['search'] . '%');
            });
        }
    
        // Filter by location if provided
        if ($filters['location'] ?? false) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }
    
        // Filter by approved cafes
        $query->where('status', 'Approved');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'cafe_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'cafe_id');
    }

    public function tables()
    {
        return $this->hasMany(Table::class, 'cafe_id', 'cafe_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class, 'cafe_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function averageRating()
    {
        return $this->feedbacks()->avg('rating');
    }

    public static function getRecommendations($userId, $top_n = 5)
    {
        // Check if user is authenticated
        if (!$userId) {
            return collect(); // Return an empty collection for guests
        }

        // Fetch personalized recommendations from Flask API
        $response = Http::get('http://127.0.0.1:5000/recommend', [
            'user_id' => $userId,
            'top_n' => $top_n,
        ]);

        $recommendations = $response->successful() ? $response->json()['recommendations'] ?? [] : [];

        // If no recommendations, fetch fallback cafes
        if (empty($recommendations)) {
            return self::getFallbackRecommendations($top_n);
        }

        // Get cafe details and map them with recommendations
        $cafeDetails = self::whereIn('cafe_id', collect($recommendations)->pluck('cafe_id'))->get();

        return collect($recommendations)->map(function ($rec) use ($cafeDetails) {
            $cafe = $cafeDetails->firstWhere('cafe_id', $rec['cafe_id']);
            return [
                'cafe_id' => $rec['cafe_id'],
                'predicted_rating' => $rec['predicted_rating'] ?? null,
                'cafe_name' => $cafe->cafe_name ?? 'Unknown Cafe',
                'logo' => $cafe->logo ?? null,
                'location' => $cafe->location ?? 'Unknown Location',
            ];
        });
    }

    private static function getFallbackRecommendations($top_n)
    {
        return self::inRandomOrder()
            ->take($top_n)
            ->get(['cafe_id', 'cafe_name', 'logo', 'location'])
            ->map(function ($cafe) {
                return [
                    'cafe_id' => $cafe->cafe_id,
                    'predicted_rating' => null,
                    'cafe_name' => $cafe->cafe_name,
                    'logo' => $cafe->logo,
                    'location' => $cafe->location,
                ];
            });
    }
}
