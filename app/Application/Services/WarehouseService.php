<?php

namespace App\Application\Services;

use App\Application\Interfaces\IWarehouseService;
use App\Application\Models\Warehouse;
use App\Infrastructure\Interfaces\IWarehouseRepository;

class WarehouseService implements IWarehouseService
{
    private $warehouseRepository;

    public function __construct(IWarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    private function mapToDomainModel($eloquentWarehouse)
    {
        return new Warehouse(
            $eloquentWarehouse->id,
            $eloquentWarehouse->name,
            $eloquentWarehouse->location
        );
    }

    public function getAllWarehouses()
    {
        $warehouses = $this->warehouseRepository->getAll();

        // Transform the collection but keep pagination intact
        $warehouses->getCollection()->transform(function ($warehouse) {
            return $this->mapToDomainModel($warehouse);
        });

        return $warehouses;  // Return the paginated result with transformed items
    }


    public function getWarehouseById($id)
    {
        $warehouse = $this->warehouseRepository->getById($id);
        return $this->mapToDomainModel($warehouse);
    }

    public function createWarehouse(array $data)
    {
        $warehouse = $this->warehouseRepository->create($data);
        return $this->mapToDomainModel($warehouse);
    }

    public function updateWarehouse($id, array $data)
    {
        $warehouse = $this->warehouseRepository->update($id, $data);
        return $this->mapToDomainModel($warehouse);
    }

    public function deleteWarehouse($id)
    {
        return $this->warehouseRepository->delete($id);
    }
}
