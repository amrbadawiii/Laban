<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Interfaces\IStockRepository;
use App\Domain\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockRepository extends BaseRepository implements IStockRepository
{
    public function __construct(Stock $model)
    {
        parent::__construct($model);
    }

    public function addCredit(array $data): void
    {
        $this->model->create([
            'product_id' => $data['product_id'],
            'credit' => $data['credit'],
            'debit' => 0,
            'warehouse_id' => $data['warehouse_id'],
            'measurement_unit_id' => $data['measurement_unit_id'],
        ]);
    }

    public function addDebit(array $data): void
    {
        $this->model->create([
            'product_id' => $data['product_id'],
            'credit' => 0,
            'debit' => $data['debit'],
            'warehouse_id' => $data['warehouse_id'],
            'measurement_unit_id' => $data['measurement_unit_id'],
        ]);
    }

    public function getAllStocks(): iterable
    {
        return $this->model->select(
            'product_id',
            'warehouse_id',
            DB::raw('SUM(credit) as total_credit'),
            DB::raw('SUM(debit) as total_debit'),
            DB::raw('GROUP_CONCAT(DISTINCT measurement_unit_id) as measurement_unit_ids'),
            DB::raw('GROUP_CONCAT(DISTINCT id) as stock_ids')
        )
            ->groupBy('product_id', 'warehouse_id')
            ->with(['product', 'warehouse'])
            ->paginate(10);
    }

    public function getStockByProduct(int $id): ?object
    {
        return $this->model->with(['product', 'warehouse', 'measurementUnit'])->find($id);
    }

    public function calculateStock(int $productId): float
    {
        $credit = $this->model->where('product_id', $productId)->sum('credit');
        $debit = $this->model->where('product_id', $productId)->sum('debit');

        return $credit - $debit;
    }
}
