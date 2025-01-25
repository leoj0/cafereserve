<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'cafe_id',
        'table_id',
        'user_id',
        'reservation_date',
        'start_time',
        'end_time',
        'guest_number',
        'special_request',
        'status',
    ];

    // Scope for past reservations
    public function scopePast($query)
    {
        return $query->whereRaw("CONCAT(reservation_date, ' ', start_time) <= ?", [Carbon::now()->toDateTimeString()]);
    }

    // Scope for future reservations
    public function scopeFuture($query)
    {
        return $query->whereRaw("CONCAT(reservation_date, ' ', start_time) > ?", [Carbon::now()->toDateTimeString()]);
    }

    protected $casts = [
        'reservation_date' => 'date',
    ];
    
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

}
