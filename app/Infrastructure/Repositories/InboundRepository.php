<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Inbound;
use App\Infrastructure\Interfaces\IInboundRepository;

class InboundRepository extends BaseRepository implements IInboundRepository
{
    public function __construct(Inbound $model)
    {
        parent::__construct($model);
    }

    /**
     * Confirm an inbound record.
     *
     * @param int $id
     * @return bool
     */
    public function confirmInbound(int $id): bool
    {
        $inbound = $this->find($id);
        $inbound->is_confirmed = true;
        return $inbound->save();
    }

    /**
     * Find an inbound record by its invoice number.
     *
     * @param string $invoiceNumber
     * @param array $relations
     * @return object|null
     */
    public function findByInvoiceNumber(string $invoiceNumber, array $relations = []): ?object
    {
        return $this->model
            ->with($relations)
            ->where('invoice_number', $invoiceNumber)
            ->first();
    }

    /**
     * Filter inbound records by a date range.
     *
     * @param string $startDate
     * @param string $endDate
     * @param array $relations
     * @return \Illuminate\Support\Collection
     */
    public function filterByDateRange(string $startDate, string $endDate, array $relations = [])
    {
        return $this->model
            ->with($relations)
            ->whereBetween('received_date', [$startDate, $endDate])
            ->get();
    }
}
