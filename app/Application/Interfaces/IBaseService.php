<?php

namespace App\Application\Interfaces;

interface IBaseService
{
    public function getAll(array $columns = ['*'], array $relations = []);
    public function getById(int $id, array $relations = []);
    public function create(array $data): object;
    public function update(int $id, array $data);
    public function delete(int $id): bool;
}
