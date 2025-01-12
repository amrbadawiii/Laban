<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\MeasurementUnit;
use App\Infrastructure\Interfaces\IMeasurementUnitRepository;

class MeasurementUnitRepository extends BaseRepository implements IMeasurementUnitRepository
{
    public function __construct(MeasurementUnit $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Unit here if needed
}
