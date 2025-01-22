<?php

namespace App\Application\Services;

use App\Application\Interfaces\IInboundService;
use App\Infrastructure\Repositories\InboundItemRepository;
use App\Infrastructure\Repositories\InboundRepository;

class InboundService implements IInboundService
{
    protected $inboundRepository;
    protected $inboundItemRepository;

    public function __construct(
        InboundRepository $inboundRepository, // Inject InboundRepository
        InboundItemRepository $inboundItemRepository // Inject InboundItemRepository
    ) {
        $this->inboundRepository = $inboundRepository;
        $this->inboundItemRepository = $inboundItemRepository;
    }

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->inboundRepository->allWoP($conditions, $columns, $relations);
    }

    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->inboundRepository->all($conditions, $columns, $relations);
    }

    public function getById(int $id, array $relations = [])
    {
        return $this->inboundRepository->find($id, ['*'], $relations);
    }

    public function create(array $data): object
    {
        return \DB::transaction(function () use ($data) {
            // Create inbound record
            $inbound = $this->inboundRepository->create([
                'reference_number' => $data['reference_number'],
                'supplier_id' => $data['supplier_id'] ?? null,
                'warehouse_id' => $data['warehouse_id'],
                'received_date' => $data['received_date'],
                'is_confirmed' => $data['is_confirmed'] ?? false,
                'invoice_number' => $data['invoice_number'] ?? null,
                'created_by' => session('user_id') ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            return $inbound;
        });
    }

    public function update(int $id, array $data): object
    {
        return \DB::transaction(function () use ($id, $data) {
            // Update inbound record
            $inbound = $this->inboundRepository->update($id, [
                'supplier_id' => $data['supplier_id'] ?? null,
                'warehouse_id' => $data['warehouse_id'] ?? null,
                'received_date' => $data['received_date'] ?? null,
                'is_confirmed' => $data['is_confirmed'] ?? false,
                'invoice_number' => $data['invoice_number'] ?? null,
                'updated_by' => session('user_id') ?? null,
            ]);

            return $inbound;
        });
    }

    public function delete(int $id): bool
    {
        return \DB::transaction(function () use ($id) {
            $this->inboundItemRepository->bulkDelete(
                $this->inboundItemRepository->allWoP(['inbound_id' => $id], ['id'])->pluck('id')->toArray()
            );

            return $this->inboundRepository->delete($id);
        });
    }

    public function confirmInbound(int $id)
    {
        $inbound = $this->inboundRepository->find($id);
        if (!$inbound) {
            throw new \Exception("Inbound record not found.");
        }

        return $this->inboundRepository->update($id, ['is_confirmed' => true]);
    }

    public function getByInvoiceNumber(string $invoiceNumber, array $relations = []): ?object
    {
        return $this->inboundRepository->customQuery(function ($query) use ($invoiceNumber, $relations) {
            // Use both $invoiceNumber and $relations explicitly in the callback
            if (!empty($relations)) {
                $query->with($relations);
            }

            return $query->where('invoice_number', $invoiceNumber)->first();
        });
    }


    public function filterByDateRange(string $startDate, string $endDate, array $relations = []): array
    {
        return $this->inboundRepository->customQuery(function ($query) use ($startDate, $endDate, $relations) {
            return $query->whereBetween('received_date', [$startDate, $endDate])->with($relations)->get();
        });
    }

    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        return $this->inboundRepository->customQuery(function ($query) use ($criteria, $relations) {
            if (!empty($relations)) {
                $query->with($relations);
            }

            foreach ($criteria as $column => $value) {
                $query->where($column, 'like', "%$value%");
            }

            return $query->get();
        });
    }

    public function addInboundItems(int $inboundId, array $items): void
    {
        // Prepare items for insertion


        $items['inbound_id'] = $inboundId;
        $items['total_price'] = $items['quantity'] * $items['unit_price'];


        // Bulk insert items
        $this->inboundItemRepository->create($items);
    }

    public function removeInboundItems(int $inboundId): void
    {
        // Delete items by IDs
        $this->inboundItemRepository->delete($inboundId);
    }

}
