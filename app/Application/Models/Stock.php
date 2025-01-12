<?php

namespace App\Application\Models;

use App\Domain\Models\Product;
use App\Domain\Models\Warehouse;
use App\Domain\Models\MeasurementUnit;

class Stock
{
    private int $id;
    private int $productId;
    private Product $product;
    private int $warehouseId;
    private Warehouse $warehouse;
    private int $measurementUnitId;
    private MeasurementUnit $measurementUnit;
    private float $incoming; // Quantity added to stock
    private float $outgoing; // Quantity removed from stock
    private string $status; // Status of the stock

    public function __construct(
        int $id,
        int $productId,
        Product $product,
        int $warehouseId,
        Warehouse $warehouse,
        int $measurementUnitId,
        MeasurementUnit $measurementUnit,
        float $incoming,
        float $outgoing,
        string $status,
    ) {
        $this->id = $id;
        $this->productId = $productId;
        $this->product = $product;
        $this->warehouseId = $warehouseId;
        $this->warehouse = $warehouse;
        $this->measurementUnitId = $measurementUnitId;
        $this->measurementUnit = $measurementUnit;
        $this->incoming = $incoming;
        $this->outgoing = $outgoing;
        $this->status = $status;
    }


    // Getters for accessing the properties

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
    public function getMeasurementUnitId(): int
    {
        return $this->measurementUnitId;
    }
    public function getMeasurementUnit(): MeasurementUnit
    {
        return $this->measurementUnit;
    }
    public function getIncoming(): float
    {
        return $this->incoming;
    }
    public function getOutgoing(): float
    {
        return $this->outgoing;
    }
    public function getStatus(): string
    {
        return $this->status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->productId,
            'product' => $this->product->toArray(),
            'warehouse_id' => $this->warehouseId,
            'warehouse' => $this->warehouse->toArray(),
            'measurement_unit_id' => $this->measurementUnitId,
            'measurement_unit' => $this->measurementUnit->toArray(),
            'incoming' => $this->incoming,
            'outgoing' => $this->outgoing,
            'status' => $this->status,
        ];
    }
}
