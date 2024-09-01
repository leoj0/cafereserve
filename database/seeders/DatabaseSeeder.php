<?php

namespace Database\Seeders;

use App\Models\Cafe;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

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

        Cafe::factory(6)->create();
    }
}
