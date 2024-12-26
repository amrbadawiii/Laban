<?php

namespace App\Infrastructure\Interfaces;

use App\Domain\Models\User;

interface IUserRepository extends IBaseRepository
{
    public function save(array $data, ?int $id = null): User;
}
