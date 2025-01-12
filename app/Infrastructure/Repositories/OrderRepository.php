<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Order;
use App\Infrastructure\Interfaces\IOrderRepository;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Order here if needed
}
