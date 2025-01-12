<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\QuotationItem;
use App\Infrastructure\Interfaces\IQuotationItemRepository;

class QuotationItemRepository extends BaseRepository implements IQuotationItemRepository
{
    public function __construct(QuotationItem $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Quotation Item here if needed
}
