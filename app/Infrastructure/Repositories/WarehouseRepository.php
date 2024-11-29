<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Interfaces\IWarehouseRepository;
use App\Domain\Models\Warehouse as EloquentWarehouse;

class WarehouseRepository implements IWarehouseRepository
{
    public function getAll()
    {
        return EloquentWarehouse::paginate(10); // Return raw Eloquent collection
    }

    public function getById($id)
    {
        return EloquentWarehouse::findOrFail($id); // Return raw Eloquent model
    }

    public function create(array $data)
    {
        return EloquentWarehouse::create($data); // Return raw Eloquent model
    }

    public function update($id, array $data)
    {
        $warehouse = EloquentWarehouse::findOrFail($id);
        $warehouse->update($data);
        return $warehouse; // Return raw Eloquent model
    }

    public function delete($id)
    {
        $warehouse = EloquentWarehouse::findOrFail($id);
        return $warehouse->delete();
    }
}
