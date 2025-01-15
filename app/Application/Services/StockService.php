<?php

namespace App\Application\Services;

use App\Application\Interfaces\IStockService;
use App\Infrastructure\Repositories\StockRepository;

class StockService implements IStockService
{
    private StockRepository $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * Get all records without pagination.
     */
    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->stockRepository->allWoP($conditions, $columns, $relations);
    }

    /**
     * Get all records with pagination.
     */
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10)
    {
        return $this->stockRepository->all($conditions, $columns, $relations, $perPage);
    }

    /**
     * Get a single record by ID.
     */
    public function getById(int $id, array $relations = [])
    {
        return $this->stockRepository->find($id, ['*'], $relations);
    }

    /**
     * Create a new record.
     */
    public function create(array $data): object
    {
        return $this->stockRepository->create($data);
    }

    /**
     * Update an existing record by ID.
     */
    public function update(int $id, array $data): object
    {
        return $this->stockRepository->update($id, $data);
    }

    /**
     * Delete a record by ID.
     */
    public function delete(int $id): bool
    {
        return $this->stockRepository->delete($id);
    }

    /**
     * Search for records based on criteria.
     */
    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        return $this->stockRepository->customQuery(function ($query) use ($criteria, $columns, $relations) {
            foreach ($criteria as $key => $value) {
                $query->where($key, $value);
            }
            $query->with($relations);
            return $query->get($columns)->toArray();
        });
    }

    /**
     * Get all products with their total stock (incoming - outgoing).
     */
    public function getProductsWithTotalStock()
    {
        $stocks = $this->stockRepository->getAllStocksGroupedByProduct();

        // Add total_stock attribute to each product
        foreach ($stocks as $stock) {
            $stock->total_stock = $stock->incoming - $stock->outgoing;
        }

        return $stocks;
    }


    /**
     * Get stock details for a specific product grouped by warehouses.
     */
    public function getProductStockGroupedByWarehouse(int $productId)
    {
        return $this->stockRepository->getStockByProductGroupedByWarehouse($productId);
    }

    /**
     * Get stock transactions for a specific product in a specific warehouse.
     */
    public function getTransactions(int $productId, int $warehouseId)
    {
        return $this->stockRepository->getStockTransactions($productId, $warehouseId);
    }
}
