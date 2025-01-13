<?php

namespace App\Application\Services;

use App\Application\Interfaces\IProductService;
use App\Application\Models\Product;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\IProductRepository;
use Illuminate\Support\Facades\Session;

class ProductService implements IProductService
{
    protected IProductRepository $repository;

    public function __construct(IProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Products with conditions.
     *
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     * @return array
     */

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $products = $this->repository->allWoP($conditions, $columns, $relations);
        return $products;
    }
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $products = $this->repository->all($conditions, $columns, $relations);
        return $products;
    }

    /**
     * Get a product by ID with optional relations.
     *
     * @param int $id
     * @param array $relations
     * @return Product
     */
    public function getById(int $id, array $relations = []): Product
    {
        $product = $this->repository->find($id, ['*'], $relations);

        return $this->mapToApplicationModel($product);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        // Only admin users are allowed to create new warehouses
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $warehouse = $this->repository->create($data);
        return $this->mapToApplicationModel($warehouse);
    }

    /**
     * Update an existing product.
     *
     * @param int $id
     * @param array $data
     * @return Product
     */
    public function update(int $id, array $data): Product
    {
        $product = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $updatedProduct = $this->repository->update($id, $data);
        return $this->mapToApplicationModel($updatedProduct);
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $warehouse = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        return $this->repository->delete($id);
    }

    /**
     * Search for products based on criteria.
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
     * @return Product
     */
    private function mapToApplicationModel($model): Product
    {
        return new Product(
            id: $model->id,
            name: $model->name,
            isProduction: $model->is_production,
            isSelling: $model->is_selling
        );
    }
}
