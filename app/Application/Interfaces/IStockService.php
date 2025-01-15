<?php

namespace App\Application\Interfaces;

use App\Application\Interfaces\IBaseService;

interface IStockService extends IBaseService
{
    public function getProductsWithTotalStock();
    public function getProductStockGroupedByWarehouse(int $productId);
    public function getTransactions(int $productId, int $warehouseId);
}
