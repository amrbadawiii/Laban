<?php

namespace App\Application\Models;

use DateTime;

class InvoiceItem
{
    private int $id;
    private int $invoiceId;
    private Invoice $invoice;
    private int $productId;
    private Product $product;
    private int $measurementUnitId;
    private MeasurementUnit $measurementUnit;
    private float $quantity;
    private float $unitPrice;
    private float $totalPrice;

    public function __construct(
        int $id,
        int $invoiceId,
        Invoice $invoice,
        int $productId,
        Product $product,
        int $measurementUnitId,
        MeasurementUnit $measurementUnit,
        float $quantity,
        float $unitPrice,
        float $totalPrice
    ) {
        $this->id = $id;
        $this->invoiceId = $invoiceId;
        $this->invoice = $invoice;
        $this->productId = $productId;
        $this->product = $product;
        $this->measurementUnitId = $measurementUnitId;
        $this->measurementUnit = $measurementUnit;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->totalPrice = $totalPrice;
    }

    // Add getters for accessing properties
    public function getId(): int
    {
        return $this->id;
    }
    public function getInvoiceId(): int
    {
        return $this->invoiceId;
    }
    public function getInvoice(): Invoice
    {
        return $this->invoice;
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
            'invoice_id' => $this->invoiceId,
            'product_id' => $this->productId,
            'measurement_unit_id' => $this->measurementUnitId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'total_price' => $this->totalPrice,
        ];
    }
}
