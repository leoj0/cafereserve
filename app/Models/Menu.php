<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'cafe_id',         
        'item_name',       
        'item_description', 
        'price',           
        'item_image',      
    ];

    // Define the relationship with Cafe
    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }
}
