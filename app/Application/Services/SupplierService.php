<?php

namespace App\Application\Services;

use App\Application\Interfaces\ISupplierService;
use App\Application\Models\Supplier;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\ISupplierRepository;
use Illuminate\Support\Facades\Session;

class SupplierService implements ISupplierService
{
    protected ISupplierRepository $repository;

    public function __construct(ISupplierRepository $repository)
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
        $suppliers = $this->repository->allWoP($conditions, $columns, $relations);
        return $suppliers;
    }
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $suppliers = $this->repository->all($conditions, $columns, $relations);
        return $suppliers;
    }

    /**
     * Get a supplier by ID with optional relations.
     *
     * @param int $id
     * @param array $relations
     * @return Supplier
     */
    public function getById(int $id, array $relations = []): Supplier
    {
        $supplier = $this->repository->find($id, ['*'], $relations);

        return $this->mapToApplicationModel($supplier);
    }

    /**
     * Create a new supplier.
     *
     * @param array $data
     * @return Supplier
     */
    public function create(array $data): Supplier
    {
        // Only admin users are allowed to create new warehouses
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $supplier = $this->repository->create($data);
        return $this->mapToApplicationModel($supplier);
    }

    /**
     * Update an existing supplier.
     *
     * @param int $id
     * @param array $data
     * @return Supplier
     */
    public function update(int $id, array $data): Supplier
    {
        $supplier = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $updatedSupplier = $this->repository->update($id, $data);
        return $this->mapToApplicationModel($updatedSupplier);
    }

    /**
     * Delete a supplier.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $supplier = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        return $this->repository->delete($id);
    }

    /**
     * Search for suppliers based on criteria.
     *
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return array
     */
    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
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
     * @return Supplier
     */
    private function mapToApplicationModel($model): Supplier
    {
        return new Supplier(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            phone: $model->phone,
            address: $model->address,
            city: $model->city,
            isActive: $model->is_active,
        );
    }
}
