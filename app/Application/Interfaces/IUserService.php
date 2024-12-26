<?php

namespace App\Application\Interfaces;

use App\Application\Models\User;

interface IUserService extends IBaseService
{
    public function createUser(array $data): User;
    public function updateUser(int $id, array $data): User;
    public function getUsersByWarehouse(int $warehouseId, array $columns = ['*'], array $relations = []): array;
}
