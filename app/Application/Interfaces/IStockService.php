<?php
namespace App\Application\Interfaces;

interface IStockService extends IBaseService
{
    public function calculateTotalStock(int $productId): float;
    public function calculateStockByWarehouse(int $productId, int $warehouseId): float;
    public function getStockDetails(int $productId);
}
