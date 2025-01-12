<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Invoice;
use App\Infrastructure\Interfaces\IInvoiceRepository;

class InvoiceRepository extends BaseRepository implements IInvoiceRepository
{
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Invoice here if needed
}
