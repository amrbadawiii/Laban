<?php

namespace App\Application\Services;

use App\Application\Interfaces\WarehouseServiceInterface;
use App\Infrastructure\Interfaces\WarehouseRepositoryInterface;
use Illuminate\Support\Collection;

class WarehouseService implements WarehouseServiceInterface
{
    protected WarehouseRepositoryInterface $warehouseRepository;

    public function __construct(WarehouseRepositoryInterface $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    /**
     * Retrieve all warehouses.
     *
     * @return Collection
     */
    public function getAllWarehouses(): Collection
    {
        return $this->warehouseRepository->all();
    }
}
