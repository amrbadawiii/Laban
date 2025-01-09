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
    private string $status; // 'pending', 'completed', 'cancelled'
    private string $type; // 'production', 'sales', 'adjustment'
    private ?string $referenceType; // Polymorphic relationship type
    private ?int $referenceId; // Polymorphic relationship ID
    private string $createdAt;
    private string $updatedAt;

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
        string $type,
        ?string $referenceType,
        ?int $referenceId,
        string $createdAt,
        string $updatedAt
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
        $this->type = $type;
        $this->referenceType = $referenceType;
        $this->referenceId = $referenceId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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

    public function getType(): string
    {
        return $this->type;
    }

    public function getReferenceType(): ?string
    {
        return $this->referenceType;
    }

    public function getReferenceId(): ?int
    {
        return $this->referenceId;
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
            'measurementUnitId' => $this->measurementUnitId,
            'measurementUnit' => $this->measurementUnit->toArray(),
            'incoming' => $this->incoming,
            'outgoing' => $this->outgoing,
            'status' => $this->status,
            'type' => $this->type,
            'referenceType' => $this->referenceType,
            'referenceId' => $this->referenceId,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
