<?php

namespace App\Application\Services;

use App\Application\Interfaces\IWarehouseService;
use App\Infrastructure\Interfaces\IWarehouseRepository;

class WarehouseService implements IWarehouseService
{
    protected IWarehouseRepository $repository;

    public function __construct(IWarehouseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $columns = ['*'], array $relations = [])
    {
        return $this->repository->all($columns, $relations);
    }

    public function getById(int $id, array $relations = []): object
    {
        return $this->repository->find($id, $relations);
    }

    public function create(array $data): object
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): object
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
