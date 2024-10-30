<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Cafe;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    // Associate the factory with the Menu model
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'cafe_id' => Cafe::factory(), // Generate a new cafe
            'item_name' => $this->faker->words(2, true), // Random item name
            'item_description' => $this->faker->optional()->paragraph(), // Optional description
            'price' => $this->faker->randomFloat(2, 5, 50), // Price between 5.00 and 50.00
            'item_image' => $this->faker->optional()->imageUrl(200, 200, 'food', true, 'dish'), // Optional image URL
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
