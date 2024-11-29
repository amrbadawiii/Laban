<?php

namespace Database\Factories;

use App\Domain\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->optional()->phoneNumber,
            'address' => $this->faker->optional()->address,
            'city' => $this->faker->optional()->city,
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}
