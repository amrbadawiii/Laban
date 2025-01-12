<?php

namespace App\Application\Models;

class OrderItem
{
    private int $id;
    private int $orderId;
    private Order $order;
    private int $productId;
    private Product $product;
    private int $measurementUnitId;
    private MeasurementUnit $measurementUnit;
    private float $quantity;
    private float $unitPrice;
    private float $totalPrice;

    public function __construct(
        int $id,
        int $orderId,
        Order $order,
        int $productId,
        Product $product,
        int $measurementUnitId,
        MeasurementUnit $measurementUnit,
        float $quantity,
        float $unitPrice,
        float $totalPrice
    ) {
        $this->id = $id;
        $this->orderId = $orderId;
        $this->order = $order;
        $this->productId = $productId;
        $this->product = $product;
        $this->measurementUnitId = $measurementUnitId;
        $this->measurementUnit = $measurementUnit;
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;
        $this->totalPrice = $totalPrice;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getOrderId(): int
    {
        return $this->orderId;
    }
    public function getOrder(): Order
    {
        return $this->order;
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
            'order_id' => $this->orderId,
            'product_id' => $this->productId,
            'measurement_unit_id' => $this->measurementUnitId,
            'quantity' => $this->quantity,
            'unit_price' => $this->unitPrice,
            'total_price' => $this->totalPrice,
        ];
    }

}
