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
            'cafe_id' => Cafe::inRandomOrder()->value('cafe_id') ?? Cafe::factory(),
            'item_name' => $this->faker->words(2, true), // Random item name
            'price' => $this->faker->randomFloat(2, 5, 50), // Price between 5.00 and 50.00
            'item_description' => $this->faker->paragraph(), // Always generate a description
            'item_image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
