<?php

namespace App\Application\Models;

use DateTime;

class Inbound
{
    private int $id;
    private string $referenceNumber;
    private int $supplierId;
    private Supplier $supplier;
    private int $warehouseId;
    private Warehouse $warehouse;
    private DateTime $receivedDate;
    private bool $isConfirmed;
    private ?string $invoiceNumber;
    private int $createdBy;
    private User $createdByuser;
    private int $updatedBy;
    private User $updatedByuser;

    public function __construct(
        int $id,
        string $referenceNumber,
        int $supplierId,
        Supplier $supplier,
        int $warehouseId,
        Warehouse $warehouse,
        DateTime $receivedDate,
        bool $isConfirmed,
        ?string $invoiceNumber,
        int $createdBy,
        User $createdByuser,
        int $updatedBy,
        User $updatedByuser,
    ) {
        $this->id = $id;
        $this->referenceNumber = $referenceNumber;
        $this->supplierId = $supplierId;
        $this->supplier = $supplier;
        $this->warehouseId = $warehouseId;
        $this->warehouse = $warehouse;
        $this->receivedDate = $receivedDate;
        $this->isConfirmed = $isConfirmed;
        $this->invoiceNumber = $invoiceNumber;
        $this->createdBy = $createdBy;
        $this->createdByuser = $createdByuser;
        $this->updatedBy = $updatedBy;
        $this->updatedByuser = $updatedByuser;
    }

    // Add getters for accessing properties
    public function getId(): int
    {
        return $this->id;
    }
    public function getReferenceNumber(): string
    {
        return $this->referenceNumber;
    }
    public function getSupplierId(): int
    {
        return $this->supplierId;
    }
    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }
    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }
    public function getReceivedDate(): DateTime
    {
        return $this->receivedDate;
    }
    public function getIsConfirmed(): bool
    {
        return $this->isConfirmed;
    }
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }
    public function getCreatedBy(): int
    {
        return $this->createdBy;
    }
    public function getCreatedByuser(): User
    {
        return $this->createdByuser;
    }
    public function getUpdatedBy(): int
    {
        return $this->updatedBy;
    }
    public function getUpdatedByuser(): User
    {
        return $this->updatedByuser;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->referenceNumber,
            'supplier_id' => $this->supplierId,
            'supplier' => $this->supplier->toArray(),
            'warehouse_id' => $this->warehouseId,
            'warehouse' => $this->warehouse->toArray(),
            'received_date' => $this->receivedDate->format('Y-m-d'),
            'is_confirmed' => $this->isConfirmed,
            'invoice_number' => $this->invoiceNumber,
            'created_by' => $this->createdBy,
            'created_by_user' => $this->createdByuser->toArray(),
            'updated_by' => $this->updatedBy,
            'updated_by_user' => $this->updatedByuser->toArray(),
        ];
    }
}
