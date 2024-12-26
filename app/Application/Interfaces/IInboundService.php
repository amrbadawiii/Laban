<?php

namespace App\Application\Interfaces;

interface IInboundService extends IBaseService
{
    public function confirmInbound(int $id): bool;
    public function getByInvoiceNumber(string $invoiceNumber, array $relations = []): ?object;
    public function filterByDateRange(string $startDate, string $endDate, array $relations = []): array;
}
