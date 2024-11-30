<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\MeasurementUnit;
use App\Infrastructure\Interfaces\IMeasurementUnitRepository;

class MeasurementUnitRepository implements IMeasurementUnitRepository
{
    public function getAll()
    {
        return MeasurementUnit::paginate(10); // Return raw Eloquent collection
    }

    public function getById($id)
    {
        return MeasurementUnit::findOrFail($id); // Return raw Eloquent model
    }

    public function create(array $data)
    {
        return MeasurementUnit::create($data); // Return raw Eloquent model
    }

    public function update($id, array $data)
    {
        $warehouse = MeasurementUnit::findOrFail($id);
        $warehouse->update($data);
        return $warehouse; // Return raw Eloquent model
    }

    public function delete($id)
    {
        $warehouse = MeasurementUnit::findOrFail($id);
        return $warehouse->delete();
    }
}
