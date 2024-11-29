<?php

namespace Database\Factories;

use App\Domain\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->faker->optional()->phoneNumber,
            'address' => $this->faker->optional()->address,
            'website' => $this->faker->optional()->url,
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }
}
