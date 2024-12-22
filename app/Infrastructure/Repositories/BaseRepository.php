<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Interfaces\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements IBaseRepository
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all records with optional conditions, columns, relations, and pagination.
     *
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10)
    {
        $query = $this->model->with($relations);

        if (!empty($conditions)) {
            $query->where($conditions);
        }

        return $query->orderByDesc('created_at')->paginate($perPage, $columns);
    }

    /**
     * Find a specific record by ID with optional relations.
     *
     * @param int $id
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->model->with($relations)->findOrFail($id, $columns);
    }

    /**
     * Create a new record.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing record by ID.
     *
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    /**
     * Delete a record by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $record = $this->find($id);
        return $record->delete();
    }

    /**
     * Retrieve records with specific conditions and optional columns and relations.
     *
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWhere(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $query = $this->model->with($relations);

        if (!empty($conditions)) {
            $query->where($conditions);
        }

        return $query->get($columns);
    }
}
