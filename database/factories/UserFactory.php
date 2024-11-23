<?php

namespace Database\Factories;

use App\Domain\Enums\UserType;
use App\Infrastructure\Models\User;
use App\Infrastructure\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // Default password
            'warehouse_id' => Warehouse::factory(), // Generates a related warehouse
            'user_type' => $this->faker->randomElement([UserType::Admin->value, UserType::User->value]),
            'remember_token' => \Str::random(10),
        ];
    }
}
