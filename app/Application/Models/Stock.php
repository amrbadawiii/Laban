<?php

// app/Application/Models/Stock.php
namespace App\Application\Models;

class Stock
{
    private int $id;
    private int $productId;
    private Product $product;
    private int $warehouseId;
    private Warehouse $warehouse;
    private float $credit;
    private float $debit;
    private int $measurementUnitId;
    private MeasurementUnit $measurementUnit;
    private string $createdAt;
    private string $updatedAt;

    // Constructor to initialize the domain model
    public function __construct(
        int $id,
        int $productId,
        Product $product,
        int $warehouseId,
        Warehouse $warehouse,
        float $credit,
        float $debit,
        int $measurementUnitId,
        MeasurementUnit $measurementUnit,
        string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->productId = $productId;
        $this->product = $product;
        $this->warehouseId = $warehouseId;
        $this->warehouse = $warehouse;
        $this->credit = $credit;
        $this->debit = $debit;
        $this->measurementUnitId = $measurementUnitId;
        $this->measurementUnit = $measurementUnit;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    // Getters for each property
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

    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }

    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }

    public function getCredit(): float
    {
        return $this->credit;
    }

    public function getDebit(): float
    {
        return $this->debit;
    }

    public function getMeasurementUnitId(): int
    {
        return $this->measurementUnitId;
    }

    public function getMeasurementUnit(): MeasurementUnit
    {
        return $this->measurementUnit;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'productId' => $this->productId,
            'product' => $this->product->toArray(),
            'warehouseId' => $this->warehouseId,
            'warehouse' => $this->warehouse->toArray(),
            'credit' => $this->credit,
            'debit' => $this->debit,
            'measurementUnitId' => $this->measurementUnitId,
            'measurementUnit' => $this->measurementUnit->toArray(),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
