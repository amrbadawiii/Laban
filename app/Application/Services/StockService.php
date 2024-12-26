<?php

namespace App\Application\Services;

use App\Application\Interfaces\IStockService;
use App\Application\Models\Stock;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\IStockRepository;
use Illuminate\Support\Facades\Auth;
use Session;

class StockService implements IStockService
{
    protected IStockRepository $stockRepository;

    public function __construct(IStockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $this->applyAccessControl($conditions);
        $data = $this->stockRepository->allWoP($conditions, $columns, $relations);
        return $data;
    }

    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $this->applyAccessControl($conditions);
        $data = $this->stockRepository->all($conditions, $columns, $relations);
        return $data;
    }

    public function getById(int $id, array $relations = [])
    {
        $data = $this->stockRepository->find($id, ['*'], $relations);
        return $data;
    }

    public function create(array $data): object
    {
        $stock = $this->stockRepository->create($data);
        return $this->mapToApplicationModel($stock);
    }

    public function update(int $id, array $data): object
    {
        $stock = $this->stockRepository->update($id, $data);
        return $this->mapToApplicationModel($stock);
    }

    public function delete(int $id): bool
    {
        return $this->stockRepository->delete($id);
    }

    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        $this->applyAccessControl($criteria);
        $data = $this->stockRepository->allWoP($criteria, $columns, $relations);
        return $this->mapToApplicationModels($data);
    }

    public function getTotalStock(int $warehouseId = null): array
    {
        $conditions = [];
        if ($warehouseId) {
            $conditions[] = ['warehouse_id', '=', $warehouseId];
        }

        $this->applyAccessControl($conditions);
        $stocks = $this->stockRepository->allWoP($conditions);

        $totalCredit = $stocks->sum('credit');
        $totalDebit = $stocks->sum('debit');

        return [
            'total_stock' => $totalCredit - $totalDebit,
            'credit' => $totalCredit,
            'debit' => $totalDebit,
        ];
    }

    private function applyAccessControl(array &$conditions): void
    {
        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            $conditions[] = ['id', '=', Session::get('warehouse_id')];
        }
    }

    /**
     * Maps a single raw data array or model to the Stock application model.
     */
    private function mapToApplicationModel($data): Stock
    {
        return new Stock(
            id: $data->id,
            productId: $data->product_id,
            product: $data->product, // Assuming a Product class is already mapped
            warehouseId: $data->warehouse_id,
            warehouse: $data->warehouse, // Assuming a Warehouse class is already mapped
            credit: $data->credit,
            debit: $data->debit,
            measurementUnitId: $data->measurement_unit_id,
            measurementUnit: $data->measurement_unit, // Assuming a MeasurementUnit class is already mapped
            createdAt: $data->created_at,
            updatedAt: $data->updated_at
        );
    }

    /**
     * Maps a collection or array of raw data arrays or models to an array of Stock application models.
     */
    private function mapToApplicationModels($data): array
    {
        return array_map(fn($item) => $this->mapToApplicationModel($item), $data->toArray());
    }
}
