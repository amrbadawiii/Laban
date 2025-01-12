<?php

namespace App\Application\Models;

class QuotationItem
{
    private int $id;
    private int $quotationId;
    private Quotation $quotation;
    private int $productId;
    private Product $product;
    private int $measurementUnitId;
    private MeasurementUnit $measurementUnit;
    private float $quantity;
    private float $unitPrice;
    private float $totalPrice;

    public function __construct(
        int $id,
        int $quotationId,
        Quotation $quotation,
        int $productId,
        Product $product,
        int $measurementUnitId,
        MeasurementUnit $measurementUnit,
        float $quantity,
        float $unitPrice,
        float $totalPrice
    ) {
        $this->id = $id;
        $this->quotationId = $quotationId;
        $this->quotation = $quotation;
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
    public function getQuotationId(): int
    {
        return $this->quotationId;
    }
    public function getQuotation(): Quotation
    {
        return $this->quotation;
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
            'quotation_id' => $this->quotationId,
            'product_id' => $this->productId,
            'measurement_unit_id' => $this->measurementUnitId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'total_price' => $this->totalPrice,
        ];
    }
}
