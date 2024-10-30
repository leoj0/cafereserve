<?php

namespace App\Models;

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
    ];
    
    public function scopeFilter($query, array $filters)
    {
        // Filter by tag if provided
        if ($filters['tag'] ?? false) {
            $query->where('cafe_tags', 'like', '%' . $filters['tag'] . '%');
        }
    
        // Filter by search terms (name, description, or tags) if provided
        if ($filters['search'] ?? false) {
            $query->where(function ($q) use ($filters) {
                $q->where('cafe_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('cafe_tags', 'like', '%' . $filters['search'] . '%');
            });
        }
    
        // Filter by location if provided
        if ($filters['location'] ?? false) {
            $query->where('location', 'like', '%' . $filters['location'] . '%');
        }
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

}
