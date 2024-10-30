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
        'position',            
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

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['reservation_date'])) {
            $query->whereDoesntHave('reservations', function ($query) use ($filters) {
                $query->whereDate('reservation_date', $filters['reservation_date'])
                      ->where(function ($q) use ($filters) {
                          $q->whereBetween('start_time', [$filters['start_time'], $filters['end_time']])
                            ->orWhereBetween('end_time', [$filters['start_time'], $filters['end_time']])
                            ->orWhere(function ($q) use ($filters) {
                                $q->where('start_time', '<=', $filters['start_time'])
                                  ->where('end_time', '>=', $filters['end_time']);
                            });
                      });
            });
        }
        
        return $query;
    }

    
    
}
