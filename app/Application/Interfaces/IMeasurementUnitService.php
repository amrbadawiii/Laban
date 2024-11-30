<?php

namespace App\Application\Interfaces;

interface IMeasurementUnitService
{
    public function getAllMeasurementUnits();
    public function getMeasurementUnitById($id);
    public function createMeasurementUnit(array $data);
    public function updateMeasurementUnit($id, array $data);
    public function deleteMeasurementUnit($id);
}
