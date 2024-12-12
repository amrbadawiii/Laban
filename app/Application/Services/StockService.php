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

    public function addCredit(array $data): void
    {
        $this->stockRepository->addCredit($data);
    }

    public function addDebit(array $data): void
    {
        $this->stockRepository->addDebit($data);
    }

    public function getAllStocks(): array
    {
        // Get the stocks from the repository
        $stocks = $this->stockRepository->getAllStocks();

        // Map to domain model
        return [
            'id' => $stocks->id,
            'productId' => $stocks->product_id,
            'product' => $stocks->product,
            'warehouseId' => $stocks->warehouse_id,
            'warehouse' => $stocks->warehouse,
            'credit' => $stocks->credit,
            'debit' => $stocks->debit,
            'measurementUnitId' => $stocks->measurement_unit_id,
            'measurementUnit' => $stocks->measurement_unit,
            'createdAt' => $stocks->created_at,
            'updatedAt' => $stocks->updated_at
        ];

    }

    public function getStockByProduct(int $productId): ?array
    {
        // Get the stock for the product from the repository
        $stock = $this->stockRepository->getStockByProduct($productId);

        // If there's no stock for this product, return null
        if (!$stock) {
            return null;
        }

        // Map to domain model
        return [
            'id' => $stock->id,
            'productId' => $stock->product_id,
            'product' => $stock->product,
            'warehouseId' => $stock->warehouse_id,
            'warehouse' => $stock->warehouse,
            'credit' => $stock->credit,
            'debit' => $stock->debit,
            'measurementUnitId' => $stock->measurement_unit_id,
            'measurementUnit' => $stock->measurement_unit,
            'createdAt' => $stock->created_at,
            'updatedAt' => $stock->updated_at
        ];
    }

    public function calculateStock(int $productId): float
    {
        return $this->stockRepository->calculateStock($productId);
    }
}
