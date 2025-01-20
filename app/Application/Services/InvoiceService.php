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
                'invoice_status' => $data['invoice_status'] ?? 'unpaid',
                'total_amount' => $data['total_amount'] ?? 0,
                'total_price' => $data['total_price'] ?? 0,
                'notes' => $data['notes'] ?? null,
                'created_by' => $data['created_by'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

            return $invoice;
        });
    }

    public function update(int $id, array $data): object
    {
        dd($data);
        return \DB::transaction(function () use ($id, $data) {
            // Update the invoice
            $invoice = $this->invoiceRepository->update($id, [
                'warehouse_id' => $data['warehouse_id'] ?? null,
                'customer_id' => $data['customer_id'] ?? null,
                'order_id' => $data['order_id'] ?? null,
                'invoice_number' => $data['invoice_number'] ?? null,
                'invoice_date' => $data['invoice_date'] ?? null,
                'invoice_status' => $data['invoice_status'] ?? null,
                'total_amount' => $data['total_amount'] ?? null,
                'total_price' => $data['total_price'] ?? 0,
                'notes' => $data['notes'] ?? null,
                'updated_by' => $data['updated_by'] ?? null,
            ]);

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

    public function addInvoiceItems(int $invoiceId, array $items): void
    {
        // Prepare items for insertion

        $items['invoice_id'] = $invoiceId;
        $items['total_price'] = $items['quantity'] * $items['unit_price'];
        $relations = [];
        $invoice = $this->invoiceRepository->find($invoiceId, ['*'], $relations);
        if (!$invoice) {
            throw new \Exception("Invoice record not found.");
        }
        $invoice->total_amount += $items['quantity'];
        $invoice->total_price += $items['total_price'];
        $invoice->save();
        // Bulk insert items
        $this->invoiceItemRepository->create($items);
    }

    public function removeInvoiceItems(int $invoiceId): void
    {
        $invoiceItem = $this->invoiceItemRepository->find($invoiceId);
        $invoice = $this->invoiceRepository->find($invoiceItem->invoice_id);
        $invoice->total_amount -= $invoiceItem->quantity;
        $invoice->total_price -= $invoice->total_price;
        $invoice->save();
        // Delete items by IDs
        $this->invoiceItemRepository->delete($invoiceId);
    }

    public function updateStatus(int $id, string $status)
    {
        $invoice = $this->invoiceRepository->find($id);
        $invoice->invoice_status = $status;
        $invoice->save();

        return $invoice;
    }
}
