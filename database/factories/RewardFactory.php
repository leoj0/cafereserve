<?php

namespace Database\Factories;

use App\Models\Reward;
use App\Models\Cafe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RewardFactory extends Factory
{
    // Associate the factory with the Reward model
    protected $model = Reward::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cafe_id' => Cafe::factory(), // Generate a new cafe
            'reward_name' => $this->faker->words(3, true), // Random reward name
            'reward_description' => $this->faker->paragraph(), // Random description
            'points_required' => $this->faker->numberBetween(10, 500), // Points required between 10-500
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
