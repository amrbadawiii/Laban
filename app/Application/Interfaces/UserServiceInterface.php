<?php

namespace App\Application\Interfaces;

use App\Domain\Models\User;

interface UserServiceInterface
{
    public function createAdmin(string $name, string $email, string $password, int $warehouseId): User;
    public function createUser(string $name, string $email, string $password, int $warehouseId): User;
}
