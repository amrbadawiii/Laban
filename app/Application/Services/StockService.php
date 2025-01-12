<?php

namespace App\Application\Services;

use App\Application\Interfaces\IStockService;
use App\Infrastructure\Interfaces\IStockRepository;
use App\Domain\Enums\StockTypeEnum;

class StockService implements IStockService
{
    protected IStockRepository $stockRepository;

    public function __construct(IStockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * Get all stocks without pagination.
     */
    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->stockRepository->allWoP($conditions, $columns, $relations);
    }

    /**
     * Get all stocks with pagination.
     */
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        return $this->stockRepository->all($conditions, $columns, $relations);
    }

    /**
     * Get a stock by ID.
     */
    public function getById(int $id, array $relations = [])
    {
        return $this->stockRepository->find($id, ['*'], $relations);
    }

    /**
     * Create a new stock entry.
     */
    public function create(array $data): object
    {
        return $this->stockRepository->create([
            'product_id' => $data['product_id'],
            'warehouse_id' => $data['warehouse_id'],
            'measurement_unit_id' => $data['measurement_unit_id'],
            'incoming' => $data['incoming'] ?? 0,
            'outgoing' => $data['outgoing'] ?? 0,
            'stock_type' => $data['stock_type'] ?? StockTypeEnum::Adjustment->value,
            'reference_type' => $data['reference_type'] ?? null,
            'reference_id' => $data['reference_id'] ?? null,
        ]);
    }

    /**
     * Update a stock entry by ID.
     */
    public function update(int $id, array $data): object
    {
        return $this->stockRepository->update($id, [
            'product_id' => $data['product_id'] ?? null,
            'warehouse_id' => $data['warehouse_id'] ?? null,
            'measurement_unit_id' => $data['measurement_unit_id'] ?? null,
            'incoming' => $data['incoming'] ?? null,
            'outgoing' => $data['outgoing'] ?? null,
            'stock_type' => $data['stock_type'] ?? null,
            'reference_type' => $data['reference_type'] ?? null,
            'reference_id' => $data['reference_id'] ?? null,
        ]);
    }

    /**
     * Delete a stock entry by ID.
     */
    public function delete(int $id): bool
    {
        return $this->stockRepository->delete($id);
    }

    /**
     * Search stocks based on criteria.
     */
    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        return $this->stockRepository->allWoP($criteria, $columns, $relations);
    }

    /**
     * Adjust stock levels (incoming/outgoing).
     */
    public function adjustStock(array $data): object
    {
        return $this->create([
            'product_id' => $data['product_id'],
            'warehouse_id' => $data['warehouse_id'],
            'measurement_unit_id' => $data['measurement_unit_id'],
            'incoming' => $data['incoming'] ?? 0,
            'outgoing' => $data['outgoing'] ?? 0,
            'stock_type' => $data['stock_type'] ?? StockTypeEnum::Adjustment->value,
            'reference_type' => $data['reference_type'] ?? null,
            'reference_id' => $data['reference_id'] ?? null,
        ]);
    }

    /**
     * Get total stock for a warehouse or overall.
     */
    public function getTotalStock(int $warehouseId = null): array
    {
        $conditions = [];
        if ($warehouseId) {
            $conditions[] = ['warehouse_id', '=', $warehouseId];
        }

        $stocks = $this->stockRepository->allWoP($conditions);

        $totalIncoming = $stocks->sum('incoming');
        $totalOutgoing = $stocks->sum('outgoing');

        return [
            'total_stock' => $totalIncoming - $totalOutgoing,
            'incoming' => $totalIncoming,
            'outgoing' => $totalOutgoing,
        ];
    }
}
