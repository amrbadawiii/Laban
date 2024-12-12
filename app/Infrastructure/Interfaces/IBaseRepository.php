<?php

namespace App\Infrastructure\Interfaces;

interface IBaseRepository
{
    public function all(array $columns = ['*'], array $relations = []);
    public function find(int $id, array $columns = ['*'], array $relations = []);
    public function create(array $attributes);
    public function update(int $id, array $attributes);
    public function delete(int $id);
}
