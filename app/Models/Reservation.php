<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}
