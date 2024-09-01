<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $primaryKey = 'table_id';

    protected $fillable = [
        'cafe_id',             
        'table_number',        
        'seating_capacity',    
        'location',            
        'availability_status',
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id', 'cafe_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['date'] ?? false && $filters['start_time'] ?? false && $filters['end_time'] ?? false) {
            $query->whereDoesntHave('reservations', function ($q) use ($filters) {
                $q->whereDate('reservation_date', $filters['date'])
                  ->where(function ($q) use ($filters) {
                      $q->whereTime('start_time', '<', $filters['end_time'])
                        ->whereTime('end_time', '>', $filters['start_time']);
                  });
            });
        }
    
        $query->where('availability_status', 'Available');

    }
    
}
