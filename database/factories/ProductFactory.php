<?php

namespace Database\Factories;

use App\Models\Product;
use App\Domain\Models\MeasurementUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['Row', 'Product']),
        ];
    }
}
