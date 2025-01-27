<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Cafe;
use App\Models\User;
use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    // Associate the factory with the Reservation model
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $cafe = Cafe::inRandomOrder()->first(); // Get a random cafe
        $table = $cafe->tables()->inRandomOrder()->first(); // Get a random table for the selected cafe
        
        // Randomly generate start and end times within a valid range (e.g., cafe hours)
        $startTime = $this->faker->dateTimeBetween('today', '+1 month')->format('Y-m-d H:i');
        $endTime = \Carbon\Carbon::parse($startTime)->addHours($this->faker->numberBetween(1, 3))->format('Y-m-d H:i'); // End time is 1-3 hours after start time
        
        // Get a random user from the database
        $user = User::inRandomOrder()->first();
    
        return [
            'user_id' => User::inRandomOrder()->value('user_id') ?? User::factory(), // If a user exists, assign their ID, else create a new user
            'table_id' => $cafe->tables()->inRandomOrder()->first(), // Assign random table id
            'cafe_id' => Cafe::inRandomOrder()->first(), // Assign random cafe id
            'reservation_date' => Carbon::parse($startTime)->format('Y-m-d'), // Extract date from start time
            'start_time' => $this->faker->dateTimeBetween('today', '+1 month')->format('Y-m-d H:i'),
            'end_time' => Carbon::parse($startTime)->addHours($this->faker->numberBetween(1, 3))->format('Y-m-d H:i'),
            'guest_number' => $this->faker->numberBetween(1, 10), // Random number of guests
            'special_request' => $this->faker->optional()->sentence(), // Optional special request
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    
}
