<?php

namespace App\Application\Interfaces;

interface IStockService extends IBaseService
{
    public function getTotalStock(int $warehouseId = null): array;
}
