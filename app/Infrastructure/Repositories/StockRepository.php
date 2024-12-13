<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Stock;
use App\Infrastructure\Interfaces\IStockRepository;

class StockRepository extends BaseRepository implements IStockRepository
{
    public function __construct(Stock $model)
    {
        parent::__construct($model);
    }

    /**
     * Get the total stock balance for a product across all warehouses.
     *
     * @param int $productId
     * @return float
     */
    public function getTotalStock(int $productId): float
    {
        return $this->model
            ->where('product_id', $productId)
            ->selectRaw('SUM(credit - debit) as total')
            ->value('total') ?? 0;
    }

    /**
     * Get the stock balance for a product in a specific warehouse.
     *
     * @param int $productId
     * @param int $warehouseId
     * @return float
     */
    public function getStockByWarehouse(int $productId, int $warehouseId): float
    {
        return $this->model
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->selectRaw('SUM(credit - debit) as total')
            ->value('total') ?? 0;
    }

    /**
     * Get all stocks for a product, grouped by warehouse.
     *
     * @param int $productId
     * @return \Illuminate\Support\Collection
     */
    public function getStocksGroupedByWarehouse(int $productId)
    {
        return $this->model
            ->where('product_id', $productId)
            ->groupBy('warehouse_id')
            ->selectRaw('warehouse_id, SUM(credit - debit) as total')
            ->get();
    }
}
