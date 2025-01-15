<?php

namespace App\Infrastructure\Interfaces;

use App\Infrastructure\Interfaces\IBaseRepository;

interface IStockRepository extends IBaseRepository
{
    /**
     * Get stocks filtered by warehouse ID.
     */
    public function getStockByWarehouse(int $warehouseId, array $conditions = [], array $columns = ['*'], array $relations = []);

    /**
     * Get stocks filtered by product ID.
     */
    public function getStockByProduct(int $productId, array $conditions = [], array $columns = ['*'], array $relations = []);

    /**
     * Get all stocks grouped by product ID.
     */
    public function getAllStocksGroupedByProduct();

    /**
     * Get stock for a specific product grouped by warehouse.
     */
    public function getStockByProductGroupedByWarehouse(int $productId);

    /**
     * Get all stock transactions for a specific product in a specific warehouse.
     */
    public function getStockTransactions(int $productId, int $warehouseId);
}
