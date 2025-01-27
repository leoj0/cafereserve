<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $primaryKey = 'reward_id';
    
    protected $fillable = [
        'reward_name',
        'reward_description',
        'points_required',
        'cafe_id',
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'cafe_id');
    }

    public function claimedRewards()
    {
        return $this->hasMany(ClaimedReward::class, 'reward_id');
    }

    public function claimedCount()
    {
        return $this->claimedRewards()->count();
    }
}
