<?php

namespace App\Application\Services;

use App\Application\Interfaces\IBaseService;
use App\Application\Interfaces\IInboundService;
use App\Infrastructure\Interfaces\IInboundRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InboundService implements IInboundService
{
    /**
     * @var IInboundRepository
     */
    protected $repository;

    /**
     * InboundService constructor.
     *
     * @param IInboundRepository $repository
     */
    public function __construct(IInboundRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retrieve all inbounds with optional columns and relations.
     *
     * @param array $columns
     * @param array $relations
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll(array $columns = ['*'], array $relations = [])
    {
        return $this->repository->all($columns, $relations);
    }

    /**
     * Retrieve a specific inbound by ID with relations.
     *
     * @param int $id
     * @param array $relations
     * @return object
     * @throws ModelNotFoundException
     */
    public function getById(int $id, array $relations = []): object
    {
        return $this->repository->find($id, ['*'], $relations);
    }

    /**
     * Create a new inbound record.
     *
     * @param array $data
     * @return object
     */
    public function create(array $data): object
    {
        return $this->repository->create($data);
    }

    /**
     * Update an existing inbound record.
     *
     * @param int $id
     * @param array $data
     * @return object
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete an inbound record.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
