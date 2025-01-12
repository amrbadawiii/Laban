<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Warehouse;
use App\Infrastructure\Interfaces\IWarehouseRepository;

class WarehouseRepository extends BaseRepository implements IWarehouseRepository
{
    public function __construct(Warehouse $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Warehouse here if needed
}
