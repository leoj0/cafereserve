<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    
    // The primary key associated with the table (optional if it's 'id')
    protected $primaryKey = 'feedback_id';

    // The attributes that are mass assignable
    protected $fillable = [
        'cafe_id',
        'user_id',
        'comments',
        'rating',
    ];

    // Relationships

    // A feedback belongs to a cafe
    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }

    // A feedback belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
