<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Table;
use App\Models\Cafe;
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
        $startTime = $this->faker->time('H:i'); // Random start time
        $endTime = date('H:i', strtotime($startTime . ' +2 hours')); // End time 2 hours after start

        return [
            'user_id' => User::factory(), // Generate new user
            'table_id' => Table::factory(), // Generate new table
            'cafe_id' => Cafe::factory(), // Generate new cafe
            'reservation_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'), // Random date within a month
            'start_time' => $startTime,
            'end_time' => $endTime,
            'guest_number' => $this->faker->numberBetween(1, 10), // Random number of guests
            'special_request' => $this->faker->optional()->sentence(), // Optional special request
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']), // Random status
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
