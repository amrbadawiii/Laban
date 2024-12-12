<?php
namespace App\Application\Interfaces;

interface IStockService
{
    public function addCredit(array $data): void;
    public function addDebit(array $data): void;
    public function getAllStocks(): array;
    public function getStockByProduct(int $productId): ?array;
    public function calculateStock(int $productId): float;
}
