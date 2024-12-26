<?php

namespace App\Infrastructure\Interfaces;

interface IStockRepository extends IBaseRepository
{
    public function getStockByWarehouse(int $warehouseId, array $conditions = [], array $columns = ['*'], array $relations = []);
    public function getStockByProduct(int $productId, array $conditions = [], array $columns = ['*'], array $relations = []);
}
