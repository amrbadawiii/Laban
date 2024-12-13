<?php

namespace App\Infrastructure\Interfaces;

interface IStockRepository extends IBaseRepository
{
    public function getTotalStock(int $productId): float;
    public function getStockByWarehouse(int $productId, int $warehouseId): float;
    public function getStocksGroupedByWarehouse(int $productId);
}
