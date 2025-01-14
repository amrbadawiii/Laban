<?php

namespace App\Application\Interfaces;

interface IQuotationService extends IBaseService
{
    // Add specific methods for quotation if needed
    public function addQuotationItems(int $quotationId, array $items): void;
    public function removeQuotationItems(int $quotationId): void;
    public function updateStatus(int $id, string $status);
}
