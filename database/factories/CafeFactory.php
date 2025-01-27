<?php

namespace Database\Factories;

use App\Models\Cafe;
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

    protected $model = Cafe::class;
    
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Generate a new user
            'cafe_name' => $this->faker->company(), // Random company name
            'phone_number' => $this->faker->phoneNumber(),
            'cafe_tags' => implode(',', $this->faker->words(3)), // Random tags (comma-separated)
            'location' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->paragraph(),
            'opening_time' => $this->faker->time('H:i'), // Random opening time
            'closing_time' => $this->faker->time('H:i'), // Random closing time
            'ssm_certificate' => $this->faker->unique()->lexify('SSM????????.pdf'), // Random SSM certificate name
            'business_license' => $this->faker->unique()->lexify('BL????????.pdf'), // Random business license name
            'admin_comment' => $this->faker->optional()->sentence(), // Random admin comment or null
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Denied']), //Random Status
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
    
    }
}