<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Customer;
use App\Infrastructure\Interfaces\ICustomerRepository;

class CustomerRepository implements ICustomerRepository
{
    public function getAll()
    {
        return Customer::paginate(10); // Return raw Eloquent collection
    }

    public function getById($id)
    {
        return Customer::findOrFail($id); // Return raw Eloquent model
    }

    public function create(array $data)
    {
        return Customer::create($data); // Return raw Eloquent model
    }

    public function update($id, array $data)
    {
        $warehouse = Customer::findOrFail($id);
        $warehouse->update($data);
        return $warehouse; // Return raw Eloquent model
    }

    public function delete($id)
    {
        $warehouse = Customer::findOrFail($id);
        return $warehouse->delete();
    }
}
