<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cafe>
 */
class CafeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::first();
        
        return [
            'user_id' => $user->user_id,
            'cafe_name' => $this->faker->company(),
            'phone_number' => $this->faker->phoneNumber(),
            'cafe_tags' => implode(', ', $this->faker->words(3)),
            'email' => $this->faker->companyEmail(),
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(5),
        ];
    }
}
