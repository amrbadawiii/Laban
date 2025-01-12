<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Quotation;
use App\Infrastructure\Interfaces\IQuotationRepository;

class QuotationRepository extends BaseRepository implements IQuotationRepository
{
    public function __construct(Quotation $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Quotation here if needed
}
