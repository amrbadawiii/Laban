<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Supplier;
use App\Infrastructure\Interfaces\ISupplierRepository;

class SupplierRepository implements ISupplierRepository
{
    public function getAll()
    {
        return Supplier::paginate(10); // Return raw Eloquent collection
    }

    public function getById($id)
    {
        return Supplier::findOrFail($id); // Return raw Eloquent model
    }

    public function create(array $data)
    {
        return Supplier::create($data); // Return raw Eloquent model
    }

    public function update($id, array $data)
    {
        $warehouse = Supplier::findOrFail($id);
        $warehouse->update($data);
        return $warehouse; // Return raw Eloquent model
    }

    public function delete($id)
    {
        $warehouse = Supplier::findOrFail($id);
        return $warehouse->delete();
    }
}
