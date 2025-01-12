<?php

namespace App\Application\Models;

use App\Domain\Models\Product;
use App\Domain\Models\Warehouse;
use App\Domain\Models\MeasurementUnit;

class Quotation
{
    private int $id;
    private int $warehouseId;
    private Warehouse $warehouse;
    private int $customerId;
    private Customer $customer;
    private string $quotationNumber;
    private string $quotationDate;
    private ?string $expiryDate;
    private string $quotationStatus;
    private float $totalAmount;
    private ?string $notes;
    private ?int $createdBy;
    private ?User $createdByUser;
    private ?int $updatedBy;
    private ?User $updatedByUser;

    public function __construct(
        int $id,
        int $warehouseId,
        Warehouse $warehouse,
        int $customerId,
        Customer $customer,
        string $quotationNumber,
        string $quotationDate,
        ?string $expiryDate,
        string $quotationStatus,
        float $totalAmount,
        ?string $notes,
        ?int $createdBy,
        ?User $createdByUser,
        ?int $updatedBy,
        ?User $updatedByUser
    ) {
        $this->id = $id;
        $this->warehouseId = $warehouseId;
        $this->warehouse = $warehouse;
        $this->customerId = $customerId;
        $this->customer = $customer;
        $this->quotationNumber = $quotationNumber;
        $this->quotationDate = $quotationDate;
        $this->expiryDate = $expiryDate;
        $this->quotationStatus = $quotationStatus;
        $this->totalAmount = $totalAmount;
        $this->notes = $notes;
        $this->createdBy = $createdBy;
        $this->createdByUser = $createdByUser;
        $this->updatedBy = $updatedBy;
        $this->updatedByUser = $updatedByUser;
    }

    // Getters for accessing the properties

    public function getId(): int
    {
        return $this->id;
    }
    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }
    public function getCustomerId(): int
    {
        return $this->customerId;
    }
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
    public function getQuotationNumber(): string
    {
        return $this->quotationNumber;
    }
    public function getQuotationDate(): string
    {
        return $this->quotationDate;
    }
    public function getExpiryDate(): ?string
    {
        return $this->expiryDate;
    }
    public function getQuotationStatus(): string
    {
        return $this->quotationStatus;
    }
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }
    public function getNotes(): ?string
    {
        return $this->notes;
    }
    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }
    public function getCreatedByUser(): ?User
    {
        return $this->createdByUser;
    }
    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }
    public function getUpdatedByUser(): ?User
    {
        return $this->updatedByUser;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'warehouse_id' => $this->warehouseId,
            'warehouse' => $this->warehouse->toArray(),
            'customer_id' => $this->customerId,
            'customer' => $this->customer->toArray(),
            'quotation_number' => $this->quotationNumber,
            'quotation_date' => $this->quotationDate,
            'expiry_date' => $this->expiryDate,
            'quotation_status' => $this->quotationStatus,
            'total_amount' => $this->totalAmount,
            'notes' => $this->notes,
            'created_by' => $this->createdBy,
            'created_by_user' => $this->createdByUser ? $this->createdByUser->toArray() : null,
            'updated_by' => $this->updatedBy,
            'updated_by_user' => $this->updatedByUser ? $this->updatedByUser->toArray() : null,
        ];
    }
}
