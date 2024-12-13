<?php

namespace App\Application\Services;

use App\Application\Interfaces\IStockService;
use App\Infrastructure\Interfaces\IStockRepository;

class StockService implements IStockService
{
    private IStockRepository $stockRepository;

    public function __construct(IStockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * Calculate the total stock balance for a product.
     *
     * @param int $productId
     * @return float
     */
    public function calculateTotalStock(int $productId): float
    {
        return $this->stockRepository->getTotalStock($productId);
    }

    /**
     * Calculate the stock balance for a product in a specific warehouse.
     *
     * @param int $productId
     * @param int $warehouseId
     * @return float
     */
    public function calculateStockByWarehouse(int $productId, int $warehouseId): float
    {
        return $this->stockRepository->getStockByWarehouse($productId, $warehouseId);
    }

    /**
     * Get a detailed stock breakdown for a product across warehouses.
     *
     * @param int $productId
     * @return \Illuminate\Support\Collection
     */
    public function getStockDetails(int $productId)
    {
        return $this->stockRepository->getStocksGroupedByWarehouse($productId);
    }

    /**
     * Create a new stock entry.
     *
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->stockRepository->create($data);
    }

    /**
     * Delete a stock entry by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->stockRepository->delete($id);
    }

    /**
     * Get all stock entries.
     *
     * @param array $columns
     * @param array $relations
     * @return \Illuminate\Support\Collection
     */
    public function getAll(array $columns = ['*'], array $relations = [])
    {
        $relations = array_merge(['product', 'warehouse', 'measurementUnit'], $relations);
        return $this->stockRepository->all($columns, $relations);
    }

    /**
     * Get a stock entry by ID.
     *
     * @param int $id
     * @param array $relations
     * @return object|null
     */
    public function getById(int $id, array $relations = [])
    {
        return $this->stockRepository->find($id, $relations);
    }

    /**
     * Update a stock entry by ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->stockRepository->update($id, $data);
    }
}
