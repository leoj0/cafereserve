<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Cafe;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    // Associate the factory with the Event model
    protected $model = Event::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cafe_id' => Cafe::factory(), // Generate a new cafe
            'event_name' => $this->faker->words(3, true), // Random event name
            'event_description' => $this->faker->paragraph(), // Random description
            'event_date' => $this->faker->dateTimeBetween('now', '+2 months'), // Event date within the next 2 months
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
