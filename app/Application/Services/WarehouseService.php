<?php

namespace App\Application\Services;

use App\Application\Interfaces\IWarehouseService;
use App\Application\Models\Warehouse;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\IWarehouseRepository;
use Illuminate\Support\Facades\Session;

class WarehouseService implements IWarehouseService
{
    protected IWarehouseRepository $repository;

    public function __construct(IWarehouseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all warehouses with conditions.
     *
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     * @return array
     */

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $warehouses = $this->repository->allWoP($conditions, $columns, $relations);
        return $warehouses;
    }
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            $conditions[] = ['id', '=', Session::get('warehouse_id')];
        }

        $warehouses = $this->repository->all($conditions, $columns, $relations);
        return $warehouses;
    }

    /**
     * Get a warehouse by ID with optional relations.
     *
     * @param int $id
     * @param array $relations
     * @return Warehouse
     */
    public function getById(int $id, array $relations = []): Warehouse
    {
        $warehouse = $this->repository->find($id, ['*'], $relations);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value && $warehouse->id !== Session::get('warehouse_id')) {
            abort(403, 'Unauthorized action.');
        }

        return $this->mapToApplicationModel($warehouse);
    }

    /**
     * Create a new warehouse.
     *
     * @param array $data
     * @return Warehouse
     */
    public function create(array $data): Warehouse
    {
        // Only admin users are allowed to create new warehouses
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $warehouse = $this->repository->create($data);
        return $this->mapToApplicationModel($warehouse);
    }

    /**
     * Update an existing warehouse.
     *
     * @param int $id
     * @param array $data
     * @return Warehouse
     */
    public function update(int $id, array $data): Warehouse
    {
        $warehouse = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value && $warehouse->id !== Session::get('warehouse_id')) {
            abort(403, 'Unauthorized action.');
        }

        $updatedWarehouse = $this->repository->update($id, $data);
        return $this->mapToApplicationModel($updatedWarehouse);
    }

    /**
     * Delete a warehouse.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $warehouse = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value && $warehouse->id !== Session::get('warehouse_id')) {
            abort(403, 'Unauthorized action.');
        }

        return $this->repository->delete($id);
    }

    /**
     * Search for warehouses based on criteria.
     *
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return array
     */
    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            $criteria[] = ['id', '=', Session::get('warehouse_id')];
        }

        $results = $this->repository->customQuery(function ($query) use ($criteria, $columns, $relations) {
            $query->with($relations);

            foreach ($criteria as $condition) {
                if (is_array($condition) && count($condition) === 3) {
                    [$column, $operator, $value] = $condition;
                    $query->where($column, $operator, $value);
                } elseif (is_array($condition) && count($condition) === 2) {
                    [$column, $value] = $condition;
                    $query->where($column, '=', $value);
                }
            }

            return $query->get($columns);
        });

        return array_map(fn($warehouse) => $this->mapToApplicationModel($warehouse)->toArray(), $results->toArray());
    }

    /**
     * Map a repository model to the application model.
     *
     * @param object $model
     * @return Warehouse
     */
    private function mapToApplicationModel($model): Warehouse
    {
        return new Warehouse(
            id: $model->id,
            name: $model->name,
            location: $model->location,
        );
    }
}
