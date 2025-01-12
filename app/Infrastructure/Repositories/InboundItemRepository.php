<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\InboundItem;
use App\Infrastructure\Interfaces\IInboundItemRepository;

class InboundItemRepository extends BaseRepository implements IInboundItemRepository
{
    public function __construct(InboundItem $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Inbound Item here if needed
}
