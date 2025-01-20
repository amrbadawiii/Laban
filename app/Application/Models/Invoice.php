<?php

namespace App\Application\Models;

class Invoice
{
    private int $id;
    private int $warehouseId;
    private Warehouse $warehouse;
    private int $customerId;
    private Customer $customer;
    private ?int $orderId;
    private ?Order $order;
    private string $invoiceNumber;
    private string $invoiceDate;
    private string $invoiceStatus;
    private float $totalAmount;
    private float $totalPrice;
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
        ?int $orderId,
        ?Order $order,
        string $invoiceNumber,
        string $invoiceDate,
        string $invoiceStatus,
        float $totalAmount,
        float $totalPrice,
        string $notes,
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
        $this->orderId = $orderId;
        $this->order = $order;
        $this->invoiceNumber = $invoiceNumber;
        $this->invoiceDate = $invoiceDate;
        $this->invoiceStatus = $invoiceStatus;
        $this->totalAmount = $totalAmount;
        $this->totalPrice = $totalPrice;
        $this->notes = $notes;
        $this->createdBy = $createdBy;
        $this->createdByUser = $createdByUser;
        $this->updatedBy = $updatedBy;
        $this->updatedByUser = $updatedByUser;
    }

    // Getters
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
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }
    public function getOrder(): ?Order
    {
        return $this->order;
    }
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }
    public function getInvoiceDate(): string
    {
        return $this->invoiceDate;
    }
    public function getInvoiceStatus(): string
    {
        return $this->invoiceStatus;
    }
    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
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
            'order_id' => $this->orderId,
            'order' => $this->order ? $this->order->toArray() : null,
            'invoice_number' => $this->invoiceNumber,
            'invoice_date' => $this->invoiceDate,
            'invoice_status' => $this->invoiceStatus,
            'total_amount' => $this->totalAmount,
            'total_price' => $this->totalPrice,
            'notes' => $this->notes,
            'created_by' => $this->createdBy,
            'created_by_user' => $this->createdByUser ? $this->createdByUser->toArray() : null,
            'updated_by' => $this->updatedBy,
            'updated_by_user' => $this->updatedByUser ? $this->updatedByUser->toArray() : null,
        ];
    }
}
