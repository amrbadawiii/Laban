<?php

namespace App\Application\Services;

use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Models\MeasurementUnit;
use App\Infrastructure\Interfaces\IMeasurementUnitRepository;

class MeasurementUnitService implements IMeasurementUnitService
{
    private IMeasurementUnitRepository $measurementUnitRepository;

    public function __construct(IMeasurementUnitRepository $measurementUnitRepository)
    {
        $this->measurementUnitRepository = $measurementUnitRepository;
    }

    public function getAllMeasurementUnits()
    {
        $units = $this->measurementUnitRepository->getAll();
        // Transform the collection but keep pagination intact
        $units->getCollection()->transform(function ($unit) {
            return $this->mapToDomainModel($unit);
        });
        return $units;
    }

    public function getMeasurementUnitById($id)
    {
        $unit = $this->measurementUnitRepository->getById($id);
        return $this->mapToDomainModel($unit);
    }

    public function createMeasurementUnit(array $data)
    {
        return $this->measurementUnitRepository->create($data);
    }

    public function updateMeasurementUnit($id, array $data)
    {
        return $this->measurementUnitRepository->update($id, $data);
    }

    public function deleteMeasurementUnit($id)
    {
        return $this->measurementUnitRepository->delete($id);
    }

    private function mapToDomainModel($eloquentMeasurementUnit)
    {
        return new MeasurementUnit(
            $eloquentMeasurementUnit->id,
            $eloquentMeasurementUnit->name_en,
            $eloquentMeasurementUnit->name_ar,
            $eloquentMeasurementUnit->abbreviation,
        );
    }
}
