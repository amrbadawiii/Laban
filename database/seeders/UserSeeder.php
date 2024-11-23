<?php

namespace Database\Seeders;

use App\Infrastructure\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin account
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'user_type' => '0',
            'password' => 'password'
        ]);

        // Create 10 regular users
        User::factory(10)->create([
            'user_type' => '1',
            'password' => 'password'
        ]);
    }
}

