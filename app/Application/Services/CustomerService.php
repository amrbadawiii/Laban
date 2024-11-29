<?php

namespace App\Application\Services;

use App\Application\Interfaces\ICustomerService;
use App\Application\Models\Customer;
use App\Infrastructure\Interfaces\ICustomerRepository;

class CustomerService implements ICustomerService
{
    private ICustomerRepository $customerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers()
    {
        $customers = $this->customerRepository->getAll();
        // Transform the collection but keep pagination intact
        $customers->getCollection()->transform(function ($customer) {
            return $this->mapToDomainModel($customer);
        });
        return $customers;
    }

    public function getCustomerById($id)
    {
        $customer = $this->customerRepository->getById($id);
        return $this->mapToDomainModel($customer);
    }

    public function createCustomer(array $data)
    {
        return $this->customerRepository->create($data);
    }

    public function updateCustomer($id, array $data)
    {
        return $this->customerRepository->update($id, $data);
    }

    public function deleteCustomer($id)
    {
        return $this->customerRepository->delete($id);
    }

    private function mapToDomainModel($eloquentCustomer)
    {
        return new Customer(
            $eloquentCustomer->id,
            $eloquentCustomer->first_name,
            $eloquentCustomer->last_name,
            $eloquentCustomer->email,
            $eloquentCustomer->phone,
            $eloquentCustomer->address,
            $eloquentCustomer->city,
            $eloquentCustomer->is_active
        );
    }
}
