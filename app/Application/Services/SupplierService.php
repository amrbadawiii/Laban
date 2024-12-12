<?php

namespace App\Application\Services;

use App\Application\Interfaces\ISupplierService;
use App\Infrastructure\Interfaces\ISupplierRepository;

class SupplierService implements ISupplierService
{
    protected ISupplierRepository $repository;

    public function __construct(ISupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(array $columns = ['*'], array $relations = []): iterable
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
