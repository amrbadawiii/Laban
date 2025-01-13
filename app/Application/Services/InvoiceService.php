<?php

namespace App\Application\Services;

use App\Application\Interfaces\IInvoiceService;
use App\Infrastructure\Repositories\InvoiceItemRepository;
use App\Infrastructure\Repositories\InvoiceRepository;

class InvoiceService implements IInvoiceService
{
    protected $invoiceRepository;
    protected $invoiceItemRepository;

    public function __construct(
        InvoiceRepository $invoiceRepository, // Inject InvoiceRepository
        InvoiceItemRepository $invoiceItemRepository // Inject InvoiceItemRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->invoiceItemRepository = $invoiceItemRepository;
    }

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->invoiceRepository->allWoP($conditions, $columns, $relations);
    }

    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->invoiceRepository->all($conditions, $columns, $relations);
    }

    public function getById(int $id, array $relations = [])
    {
        return $this->invoiceRepository->find($id, ['*'], $relations);
    }

    public function create(array $data): object
    {
        return \DB::transaction(function () use ($data) {
            // Create the invoice
            $invoice = $this->invoiceRepository->create([
                'warehouse_id' => $data['warehouse_id'],
                'customer_id' => $data['customer_id'],
                'order_id' => $data['order_id'] ?? null,
                'invoice_number' => $data['invoice_number'],
                'invoice_date' => $data['invoice_date'],
                'due_date' => $data['due_date'] ?? null,
                'invoice_status' => $data['invoice_status'] ?? 'unpaid',
                'total_amount' => $data['total_amount'] ?? 0,
                'paid_amount' => $data['paid_amount'] ?? 0,
                'balance_due' => $data['balance_due'] ?? 0,
                'notes' => $data['notes'] ?? null,
                'created_by' => $data['created_by'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            // Create invoice items
            if (isset($data['items']) && is_array($data['items'])) {
                foreach ($data['items'] as $item) {
                    $item['invoice_id'] = $invoice->id; // Add invoice_id to item data
                }
                $this->invoiceItemRepository->bulkCreate($data['items']);
            }

            return $invoice;
        });
    }

    public function update(int $id, array $data): object
    {
        return \DB::transaction(function () use ($id, $data) {
            // Update the invoice
            $invoice = $this->invoiceRepository->update($id, [
                'warehouse_id' => $data['warehouse_id'] ?? null,
                'customer_id' => $data['customer_id'] ?? null,
                'order_id' => $data['order_id'] ?? null,
                'invoice_number' => $data['invoice_number'] ?? null,
                'invoice_date' => $data['invoice_date'] ?? null,
                'due_date' => $data['due_date'] ?? null,
                'invoice_status' => $data['invoice_status'] ?? null,
                'total_amount' => $data['total_amount'] ?? null,
                'paid_amount' => $data['paid_amount'] ?? null,
                'balance_due' => $data['balance_due'] ?? null,
                'notes' => $data['notes'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            // Update or replace invoice items
            if (isset($data['items']) && is_array($data['items'])) {
                // Option 1: Delete old items and insert new ones
                $this->invoiceItemRepository->bulkDelete(
                    $this->invoiceItemRepository->allWoP(
                        ['invoice_id' => $id],
                        ['id']
                    )->pluck('id')->toArray()
                );

                foreach ($data['items'] as $item) {
                    $item['invoice_id'] = $id; // Add invoice_id to item data
                }
                $this->invoiceItemRepository->bulkCreate($data['items']);
            }

            return $invoice;
        });
    }

    public function delete(int $id): bool
    {
        return \DB::transaction(function () use ($id) {
            // Delete invoice items
            $this->invoiceItemRepository->bulkDelete(
                $this->invoiceItemRepository->allWoP(['invoice_id' => $id], ['id'])->pluck('id')->toArray()
            );

            // Delete the invoice
            return $this->invoiceRepository->delete($id);
        });
    }

    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        return $this->invoiceRepository->customQuery(function ($query) use ($criteria) {
            // Apply custom search logic
            foreach ($criteria as $column => $value) {
                $query->where($column, 'like', "%$value%");
            }
            return $query->get();
        });
    }
}
