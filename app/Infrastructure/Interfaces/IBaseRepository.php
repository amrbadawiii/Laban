<?php

namespace App\Infrastructure\Interfaces;

interface IBaseRepository
{
    public function allWoP(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10, array $orderBy = ['created_at' => 'desc']);
    public function all(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10, array $orderBy = ['created_at' => 'desc']);
    public function find(int $id, array $columns = ['*'], array $relations = []);
    public function getAllWithTrashed(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10, array $orderBy = ['created_at' => 'desc']);
    public function create(array $data);
    public function update(int $id, array $data);
    public function bulkCreate(array $data);
    public function bulkDelete(array $ids): int;
    public function customQuery(callable $callback);
    public function delete(int $id): bool;
}
