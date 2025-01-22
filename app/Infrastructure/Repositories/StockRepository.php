<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Stock;
use App\Infrastructure\Interfaces\IStockRepository;
use Override;

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

    /**
     * Get all stocks grouped by product ID.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllStocksGroupedByProduct()
    {
        return $this->model->select(
            'product_id',
            \DB::raw('SUM(incoming) as incoming'),
            \DB::raw('SUM(outgoing) as outgoing')
        )
            ->with('product')
            ->groupBy('product_id')
            ->get();
    }

    /**
     * Get stock for a specific product grouped by warehouse.
     *
     * @param int $productId
     * @return \Illuminate\Support\Collection
     */
    public function getStockByProductGroupedByWarehouse(int $productId)
    {
        return $this->model->select(
            'warehouse_id',
            \DB::raw('SUM(incoming) as incoming'),
            \DB::raw('SUM(outgoing) as outgoing')
        )
            ->where('product_id', $productId)
            ->with('warehouse')
            ->groupBy('warehouse_id')
            ->get();
    }

    /**
     * Get all stock transactions for a specific product in a specific warehouse.
     *
     * @param int $productId
     * @param int $warehouseId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getStockTransactions(int $productId, int $warehouseId)
    {
        return $this->model->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function delete(int $id): bool
    {
        $records = $this->model->where('reference_id', $id)->get();
        foreach ($records as $record) {
            $record->delete();
        }
        return true;
    }
}
