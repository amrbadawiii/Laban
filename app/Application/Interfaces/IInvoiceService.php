<?php

namespace App\Application\Interfaces;

interface IInvoiceService extends IBaseService
{
    // Add specific methods for invoice if needed
    public function addInvoiceItems(int $invoiceId, array $items): void;
    public function removeInvoiceItems(int $invoiceId): void;
    public function updateStatus(int $id, string $status);
}
