<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Domain\Models\Company;
use App\Domain\Models\Customer;
use App\Domain\Models\MeasurementUnit;
use App\Domain\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Companies
        Company::factory(50)->create();

        // Seed Customers
        Customer::factory(100)->create();

        // Seed Suppliers
        Supplier::factory(30)->create();

        // Seed Measurement Units
        MeasurementUnit::factory(3)->create();

        // Seed Products
        Supplier::factory(30)->create();

        $this->call([
            WarehouseSeeder::class, // Optional: seed warehouses
            UserSeeder::class,
        ]);
    }
}
