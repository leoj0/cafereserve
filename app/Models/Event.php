<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $primaryKey = 'event_id';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'cafe_id',
        'event_name',
        'event_description',
        'event_date',
        'event_time',
    ];

    // Specify the attributes that should be cast to native types
    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime',
    ];

    // Define relationships
    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }
}
