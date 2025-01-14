<?php

namespace App\Application\Services;

use App\Application\Interfaces\IQuotationService;
use App\Infrastructure\Repositories\QuotationItemRepository;
use App\Infrastructure\Repositories\QuotationRepository;

class QuotationService implements IQuotationService
{
    protected $quotationRepository;
    protected $quotationItemRepository;

    public function __construct(
        QuotationRepository $quotationRepository, // Inject QuotationRepository
        QuotationItemRepository $quotationItemRepository // Inject QuotationItemRepository
    ) {
        $this->quotationRepository = $quotationRepository;
        $this->quotationItemRepository = $quotationItemRepository;
    }

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->quotationRepository->allWoP($conditions, $columns, $relations);
    }

    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->quotationRepository->all($conditions, $columns, $relations);
    }

    public function getById(int $id, array $relations = [])
    {
        return $this->quotationRepository->find($id, ['*'], $relations);
    }

    public function create(array $data): object
    {
        return \DB::transaction(function () use ($data) {
            // Create the quotation record
            $quotation = $this->quotationRepository->create([
                'warehouse_id' => $data['warehouse_id'],
                'customer_id' => $data['customer_id'],
                'quotation_number' => $data['quotation_number'],
                'quotation_date' => $data['quotation_date'],
                'expiry_date' => $data['expiry_date'] ?? null,
                'quotation_status' => $data['quotation_status'] ?? 'draft',
                'total_amount' => $data['total_amount'] ?? 0,
                'notes' => $data['notes'] ?? null,
                'created_by' => $data['created_by'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            // Create quotation items
            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    $item['quotation_id'] = $quotation->id; // Add quotation_id to item data
                }
                $this->quotationItemRepository->bulkCreate($data['items']);
            }

            return $quotation;
        });
    }

    public function update(int $id, array $data): object
    {
        return \DB::transaction(function () use ($id, $data) {
            // Update the quotation record
            $quotation = $this->quotationRepository->update($id, [
                'warehouse_id' => $data['warehouse_id'] ?? null,
                'customer_id' => $data['customer_id'] ?? null,
                'quotation_number' => $data['quotation_number'] ?? null,
                'quotation_date' => $data['quotation_date'] ?? null,
                'expiry_date' => $data['expiry_date'] ?? null,
                'quotation_status' => $data['quotation_status'] ?? null,
                'total_amount' => $data['total_amount'] ?? null,
                'notes' => $data['notes'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            // Update or replace quotation items
            if (isset($data['items']) && is_array($data['items'])) {
                // Option 1: Delete old items and insert new ones
                $this->quotationItemRepository->bulkDelete(
                    $this->quotationItemRepository->allWoP(
                        ['quotation_id' => $id],
                        ['id']
                    )->pluck('id')->toArray()
                );

                foreach ($data['items'] as $item) {
                    $item['quotation_id'] = $id; // Add quotation_id to item data
                }
                $this->quotationItemRepository->bulkCreate($data['items']);
            }

            return $quotation;
        });
    }

    public function delete(int $id): bool
    {
        return \DB::transaction(function () use ($id) {
            // Delete quotation items
            $this->quotationItemRepository->bulkDelete(
                $this->quotationItemRepository->allWoP(['quotation_id' => $id], ['id'])->pluck('id')->toArray()
            );

            // Delete quotation
            return $this->quotationRepository->delete($id);
        });
    }

    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        return $this->quotationRepository->customQuery(function ($query) use ($criteria) {
            // Apply custom search logic
            foreach ($criteria as $column => $value) {
                $query->where($column, 'like', "%$value%");
            }
            return $query->get();
        });
    }

    public function addQuotationItems(int $quotationId, array $items): void
    {
        // Prepare items for insertion

        $items['quotation_id'] = $quotationId;
        $items['total_price'] = $items['quantity'] * $items['unit_price'];
        $relations = [];
        $quotation = $this->quotationRepository->find($quotationId, ['*'], $relations);
        if (!$quotation) {
            throw new \Exception("Quotation record not found.");
        }
        $quotation->total_amount += $items['quantity'];
        $quotation->save();
        // Bulk insert items
        $this->quotationItemRepository->create($items);
    }

    public function removeQuotationItems(int $quotationId): void
    {
        $quotationItem = $this->quotationItemRepository->find($quotationId);
        $order = $this->quotationRepository->find($quotationItem->quotation_id);
        $order->total_amount -= $quotationItem->quantity;
        $order->save();
        // Delete items by IDs
        $this->quotationItemRepository->delete($quotationId);
    }

    public function updateStatus(int $id, string $status)
    {
        $order = $this->quotationRepository->find($id);
        $order->order_status = $status;
        $order->save();

        return $order;
    }
}
