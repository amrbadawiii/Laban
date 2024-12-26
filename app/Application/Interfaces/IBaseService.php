<?php

namespace App\Application\Interfaces;

interface IBaseService
{
    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = []);
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = []);
    public function getById(int $id, array $relations = []);
    public function create(array $data): object;
    public function update(int $id, array $data): object;
    public function delete(int $id): bool;
    public function search(array $criteria, array $columns = ['*'], array $relations = []): array;
}
