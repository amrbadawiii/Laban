<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\InvoiceItem;
use App\Infrastructure\Interfaces\IInvoiceRepository;

class InvoiceItemRepository extends BaseRepository implements IInvoiceRepository
{
    public function __construct(InvoiceItem $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Invoice Item here if needed
}
