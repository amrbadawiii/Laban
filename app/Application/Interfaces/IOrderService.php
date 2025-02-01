<?php

namespace App\Application\Interfaces;

interface IOrderService extends IBaseService
{
    // Add specific methods for order if needed
    public function getAllWithTrashed(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10, array $orderBy = ['created_at' => 'desc']);
    public function addOrderItems(int $orderId, array $items): void;
    public function removeOrderItems(int $orderId): void;
    public function updateStatus(int $id, string $status);
}
