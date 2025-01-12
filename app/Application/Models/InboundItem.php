<?php

namespace App\Application\Models;

class InboundItem
{
    private int $id;
    private int $inboundId;
    private Inbound $inbound;
    private int $productId;
    private Product $product;
    private int $measurementUnitId;
    private MeasurementUnit $measurementUnit;
    private float $quantity;
    private float $unitPrice;
    private float $totalPrice;

    public function __construct(
        int $id,
        int $inboundId,
        Inbound $inbound,
        int $productId,
        Product $product,
        int $measurementUnitId,
        MeasurementUnit $measurementUnit,
        float $quantity,
        float $unitPrice,
        float $totalPrice
    ) {
        $this->id = $id;
        $this->inboundId = $inboundId;
        $this->inbound = $inbound;
        $this->productId = $productId;
        $this->product = $product;
        $this->measurementUnitId = $measurementUnitId;
        $this->measurementUnit = $measurementUnit;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->totalPrice = $totalPrice;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getInboundId(): int
    {
        return $this->inboundId;
    }

    public function getInbound(): Inbound
    {
        return $this->inbound;
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

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'inbound_id' => $this->inboundId,
            'product_id' => $this->productId,
            'measurement_unit_id' => $this->measurementUnitId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'total_price' => $this->totalPrice,
        ];
    }
}
