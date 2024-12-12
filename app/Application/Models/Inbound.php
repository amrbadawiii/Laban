<?php

namespace App\Application\Models;

use DateTime;

class Inbound
{
    private int $id;
    private int $productId;
    private Product $product;
    private int $measurementUnitId;
    private MeasurementUnit $measurementUnit;
    private float $quantity;
    private int $supplierId;
    private Supplier $supplier;
    private int $warehouseId;
    private Warehouse $warehouse;
    private DateTime $receivedDate;
    private bool $isConfirmed;
    private ?string $invoiceNumber;

    public function __construct(
        int $id,
        int $productId,
        Product $product,
        int $measurementUnitId,
        MeasurementUnit $measurementUnit,
        float $quantity,
        int $supplierId,
        Supplier $supplier,
        int $warehouseId,
        Warehouse $warehouse,
        DateTime $receivedDate,
        bool $isConfirmed,
        ?string $invoiceNumber
    ) {
        $this->id = $id;
        $this->productId = $productId;
        $this->product = $product;
        $this->measurementUnitId = $measurementUnitId;
        $this->measurementUnit = $measurementUnit;
        $this->quantity = $quantity;
        $this->supplierId = $supplierId;
        $this->supplier = $supplier;
        $this->warehouseId = $warehouseId;
        $this->warehouse = $warehouse;
        $this->receivedDate = $receivedDate;
        $this->isConfirmed = $isConfirmed;
        $this->invoiceNumber = $invoiceNumber;
    }

    // Add getters for accessing properties
    public function getId(): int
    {
        return $this->id;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getProduct(): Product
    {
        return $this->product;
    }
    public function getMeasurementUnitId(): int
    {
        return $this->measurementUnitId;
    }

    public function getMeasurementUnit(): MeasurementUnit
    {
        return $this->measurementUnit;
    }
    public function getQuantity(): float
    {
        return $this->quantity;
    }
    public function getSupplierId(): ?int
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
    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->productId,
            'product' => $this->product ? $this->product->toArray() : null,
            'measurement_unit_id' => $this->measurementUnitId,
            'measurement_unit' => $this->measurementUnit ? $this->measurementUnit->toArray() : null,
            'quantity' => $this->quantity,
            'supplier_id' => $this->supplierId,
            'supplier' => $this->supplier ? $this->supplier->toArray() : null,
            'warehouse_id' => $this->warehouseId,
            'warehouse' => $this->warehouse ? $this->warehouse->toArray() : null,
            'received_date' => $this->receivedDate->format('Y-m-d'), // Format the DateTime
            'is_confirmed' => $this->isConfirmed,
            'invoice_number' => $this->invoiceNumber,
        ];
    }
}
