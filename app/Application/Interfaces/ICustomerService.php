<?php

namespace App\Application\Interfaces;

interface ICustomerService
{
    public function getAllCustomers();
    public function getCustomerById($id);
    public function createCustomer(array $data);
    public function updateCustomer($id, array $data);
    public function deleteCustomer($id);
}
