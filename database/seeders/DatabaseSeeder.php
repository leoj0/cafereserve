<?php

namespace Database\Seeders;

use App\Models\Cafe;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\User;
use App\Models\Table;
use App\Models\Reward;
use App\Models\Feedback;
use App\Models\Reservation;
use App\Models\ClaimedReward;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();

        // Create a specific Customer
        User::factory()->create([
            'role' => 'Customer',
            'name' => 'John Doe',
            'email' => 'customer@gmail.com',
        ]);

        // Create a specific Owner
        User::factory()->create([
            'role' => 'Owner',
            'name' => 'Jane Smith',
            'email' => 'owner@gmail.com',
        ]);

        User::factory()->create([
            'role' => 'Admin',
            'name' => 'Jane Smith',
            'email' => 'admin@gmail.com',
        ]);

        Cafe::factory(20)->create();

        ClaimedReward::factory(5)->create();

        Feedback::factory(100)->create();

        Menu::factory(100)->create();

        Table::factory(20)->create();

        Reward::factory(100)->create();

    }
}
