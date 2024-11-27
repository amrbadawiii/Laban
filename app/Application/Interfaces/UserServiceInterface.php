<?php

namespace App\Application\Interfaces;

use App\Domain\Models\User;
use Illuminate\Support\Collection;

interface UserServiceInterface
{
    /**
     * Retrieve all registered users.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection;

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User;
}
