<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimedReward extends Model
{
    use HasFactory;

    protected $primaryKey = 'claimed_reward_id';

    protected $fillable = ['user_id', 'reward_id', 'claimed_at', 'used_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }

    protected $casts = [
        'claimed_at' => 'datetime',
        'used_at' => 'datetime',
    ];
}
