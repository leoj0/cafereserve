<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\Cafe;
use Illuminate\Database\Eloquent\Factories\Factory;

class TableFactory extends Factory
{
    // Associate the factory with the Table model
    protected $model = Table::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cafe_id' => Cafe::factory(), // Generate a new cafe
            'table_number' => $this->faker->unique()->numberBetween(1, 100), // Random unique table number
            'seating_capacity' => $this->faker->numberBetween(2, 10), // Random seating capacity
            'position' => $this->faker->randomElement(['Window', 'Center', 'Corner', 'Outdoor']), // Optional position
            'is_bookable' => $this->faker->boolean(80), // 80% chance of being true
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
