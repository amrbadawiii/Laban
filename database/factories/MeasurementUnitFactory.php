<?php

namespace Database\Factories;

use App\Domain\Models\MeasurementUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeasurementUnitFactory extends Factory
{
    protected $model = MeasurementUnit::class;
    public function definition()
    {
        $unitsEn = ['kilogram', 'ton', 'gram'];
        $unitsAr = ['كيلوجرام', 'طن', 'جرام'];
        $abv = ['kg', 'tn', 'g'];
        return [
            'name_en' => $this->faker->randomElement($unitsEn),
            'name_ar' => $this->faker->randomElement($unitsAr),
            'abbreviation' => $this->faker->randomElement($abv),
        ];
    }
}
