<?php

namespace Database\Factories;

use App\Domain\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->optional()->address,
            'city' => $this->faker->optional()->city,
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}
