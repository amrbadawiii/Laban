<?php

namespace App\Infrastructure\Interfaces;

interface IInboundRepository extends IBaseRepository
{
    public function confirmInbound(int $id): bool;
    public function findByInvoiceNumber(string $invoiceNumber, array $relations = []): ?object;
    public function filterByDateRange(string $startDate, string $endDate, array $relations = []);
}
