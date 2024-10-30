<?php

namespace Database\Factories;

use App\Models\ClaimedReward;
use App\Models\User;
use App\Models\Cafe;
use App\Models\Reward;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaimedRewardFactory extends Factory
{
    // Associate the factory with the ClaimedReward model
    protected $model = ClaimedReward::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $claimedAt = $this->faker->dateTimeBetween('-1 month', 'now'); // Random claim date within the last month
        $usedAt = $this->faker->optional(0.5)->dateTimeBetween($claimedAt, 'now'); // 50% chance it was used

        return [
            'user_id' => User::factory(), // Generate a new user
            'cafe_id' => Cafe::factory(), // Generate a new cafe
            'reward_id' => Reward::factory(), // Generate a new reward
            'claimed_at' => $claimedAt,
            'used_at' => $usedAt, // Optional used date
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
