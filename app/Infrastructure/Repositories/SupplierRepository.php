<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Supplier;
use App\Infrastructure\Interfaces\ISupplierRepository;

class SupplierRepository extends BaseRepository implements ISupplierRepository
{
    public function __construct(Supplier $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Supplier here if needed
}
