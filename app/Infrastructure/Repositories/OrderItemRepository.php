<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\OrderItem;
use App\Infrastructure\Interfaces\IOrderItemRepository;

class OrderItemRepository extends BaseRepository implements IOrderItemRepository
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Order Item here if needed
}
