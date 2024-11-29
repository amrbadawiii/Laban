<?php

namespace App\Application\Interfaces;

interface IWarehouseService
{
    public function getAllWarehouses();
    public function getWarehouseById($id);
    public function createWarehouse(array $data);
    public function updateWarehouse($id, array $data);
    public function deleteWarehouse($id);
}
