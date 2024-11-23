<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    public function run()
    {
        Warehouse::factory(5)->create(); // Create 5 warehouses
    }
}

