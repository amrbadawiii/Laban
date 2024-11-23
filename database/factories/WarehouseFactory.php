<?php
namespace Database\Factories;

use App\Infrastructure\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    protected $model = Warehouse::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(), // Generate a random warehouse name
            'location' => $this->faker->city()
        ];
    }
}
