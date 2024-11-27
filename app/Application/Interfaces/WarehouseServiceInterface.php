<?php

namespace App\Application\Interfaces;

use Illuminate\Support\Collection;

interface WarehouseServiceInterface
{
    /**
     * Retrieve all warehouses.
     *
     * @return Collection
     */
    public function getAllWarehouses(): Collection;
}
