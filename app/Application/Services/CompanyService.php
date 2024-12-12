<?php

namespace App\Application\Services;

use App\Application\Interfaces\ICompanyService;
use App\Infrastructure\Interfaces\ICompanyRepository;

class CompanyService implements ICompanyService
{
    protected ICompanyRepository $repository;

    public function __construct(ICompanyRepository $repository)
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
