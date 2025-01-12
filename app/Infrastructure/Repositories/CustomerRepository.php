<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Customer;
use App\Infrastructure\Interfaces\ICustomerRepository;

class CustomerRepository extends BaseRepository implements ICustomerRepository
{
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Customer here if needed
}
