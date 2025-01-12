<?php

namespace App\Application\Models;

class Order
{
    private int $id;
    private int $warehouseId;
    private Warehouse $warehouse;
    private int $customerId;
    private Customer $customer;
    private string $orderNumber;
    private string $orderDate;
    private ?string $deliveryDate;
    private string $orderStatus;
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
        string $orderNumber,
        string $orderDate,
        ?string $deliveryDate,
        string $orderStatus,
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
        $this->orderNumber = $orderNumber;
        $this->orderDate = $orderDate;
        $this->deliveryDate = $deliveryDate;
        $this->orderStatus = $orderStatus;
        $this->totalAmount = $totalAmount;
        $this->notes = $notes;
        $this->createdBy = $createdBy;
        $this->createdByUser = $createdByUser;
        $this->updatedBy = $updatedBy;
        $this->updatedByUser = $updatedByUser;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getWarehouseId()
    {
        return $this->warehouseId;
    }
    public function getWarehouse()
    {
        return $this->warehouse;
    }
    public function getCustomerId()
    {
        return $this->customerId;
    }
    public function getCustomer()
    {
        return $this->customer;
    }
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }
    public function getOrderDate()
    {
        return $this->orderDate;
    }
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }
    public function getNotes()
    {
        return $this->notes;
    }
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
    public function getCreatedByUser()
    {
        return $this->createdByUser;
    }
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
    public function getUpdatedByUser()
    {
        return $this->updatedByUser;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'warehouseId' => $this->warehouseId,
            'warehouse' => $this->warehouse->toArray(),
            'customerId' => $this->customerId,
            'customer' => $this->customer->toArray(),
            'orderNumber' => $this->orderNumber,
            'orderDate' => $this->orderDate,
            'deliveryDate' => $this->deliveryDate,
            'orderStatus' => $this->orderStatus,
            'totalAmount' => $this->totalAmount,
            'notes' => $this->notes,
            'createdBy' => $this->createdBy,
            'createdByUser' => $this->createdByUser ? $this->createdByUser->toArray() : null,
            'updatedBy' => $this->updatedBy,
            'updatedByUser' => $this->updatedByUser ? $this->updatedByUser->toArray() : null,
        ];
    }
}
