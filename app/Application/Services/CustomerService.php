<?php

namespace App\Application\Services;

use App\Application\Interfaces\ICustomerService;
use App\Application\Models\Customer;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\ICustomerRepository;
use Illuminate\Support\Facades\Session;

class CustomerService implements ICustomerService
{
    protected ICustomerRepository $repository;

    public function __construct(ICustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Customers with conditions.
     *
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     * @return array
     */

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $customers = $this->repository->allWoP($conditions, $columns, $relations);
        return $customers;
    }
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $customers = $this->repository->all($conditions, $columns, $relations);
        return $customers;
    }

    /**
     * Get a Customer by ID with optional relations.
     *
     * @param int $id
     * @param array $relations
     * @return Customer
     */
    public function getById(int $id, array $relations = []): Customer
    {
        $customer = $this->repository->find($id, ['*'], $relations);

        return $this->mapToApplicationModel($customer);
    }

    /**
     * Create a new Customer.
     *
     * @param array $data
     * @return Customer
     */
    public function create(array $data): Customer
    {
        // Only admin users are allowed to create new Customers
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $customer = $this->repository->create($data);
        return $this->mapToApplicationModel($customer);
    }

    /**
     * Update an existing Customer.
     *
     * @param int $id
     * @param array $data
     * @return Customer
     */
    public function update(int $id, array $data): Customer
    {
        $customer = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $updatedCustomer = $this->repository->update($id, $data);
        return $this->mapToApplicationModel($updatedCustomer);
    }

    /**
     * Delete a Customer.
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
     * Search for customers based on criteria.
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
     * @return Customer
     */
    private function mapToApplicationModel($model): Customer
    {
        return new Customer(
            id: $model->id,
            firstName: $model->first_name,
            lastName: $model->last_name,
            email: $model->email,
            phone: $model->phone,
            address: $model->address,
            city: $model->city,
            isActive: $model->is_active,
        );
    }
}
