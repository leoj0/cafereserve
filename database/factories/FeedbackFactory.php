<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Cafe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    // Associate the factory with the Feedback model
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cafe_id' => Cafe::factory(), // Generate a new cafe
            'user_id' => User::factory(), // Generate a new user
            'comments' => $this->faker->sentence(), // Random comment
            'rating' => $this->faker->numberBetween(1, 5), // Random rating from 1 to 5
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
