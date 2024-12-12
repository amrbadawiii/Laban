<?php

namespace App\Infrastructure\Interfaces;

interface IStockRepository extends IBaseRepository
{
    public function addCredit(array $data): void;
    public function addDebit(array $data): void;
    public function getAllStocks(): iterable;
    public function getStockByProduct(int $id): ?object;
    public function calculateStock(int $productId): float;
}
