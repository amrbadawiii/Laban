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

    public function allWoP(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10, array $orderBy = ['created_at' => 'desc'])
    {
        $query = $this->buildQuery($conditions, $relations, $orderBy);
        return $query->get($columns);
    }

    public function all(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10, array $orderBy = ['created_at' => 'desc'])
    {
        $query = $this->buildQuery($conditions, $relations, $orderBy);
        return $query->paginate($perPage, $columns);
    }

    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        return $this->model->with($relations)->findOrFail($id, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);
        return $record;
    }

    public function delete(int $id): bool
    {
        $record = $this->find($id);
        return $record->delete();
    }

    public function bulkCreate(array $data)
    {
        return $this->model->insert($data);
    }

    public function bulkDelete(array $ids): int
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function customQuery(callable $callback)
    {
        $query = $this->model->newQuery();
        return $callback($query);
    }

    private function buildQuery(array $conditions = [], array $relations = [], array $orderBy = [])
    {
        // Start with a fresh query builder instance
        $query = $this->model->newQuery();

        // Apply relations if provided
        if (!empty($relations)) {
            $query->with($relations);
        }

        // Apply conditions dynamically
        foreach ($conditions as $condition) {
            if (is_array($condition) && count($condition) === 3) {
                [$column, $operator, $value] = $condition;
                $query->where($column, $operator, $value);
            } elseif (is_array($condition) && count($condition) === 2) {
                [$column, $value] = $condition;
                $query->where($column, '=', $value);
            }
        }

        // Apply ordering if provided
        foreach ($orderBy as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query;
    }


}
