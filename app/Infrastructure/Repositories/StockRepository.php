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
     * Get stocks filtered by warehouse ID.
     *
     * @param int $warehouseId
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     *
     */
    public function getStockByWarehouse(int $warehouseId, array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $conditions[] = ['warehouse_id', '=', $warehouseId];
        $query = $this->buildQuery($conditions, $relations);

        return $query->get($columns);
    }

    /**
     * Get stocks filtered by product ID.
     *
     * @param int $productId
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     *
     */
    public function getStockByProduct(int $productId, array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $conditions[] = ['product_id', '=', $productId];
        $query = $this->buildQuery($conditions, $relations);

        return $query->get($columns);
    }
}
