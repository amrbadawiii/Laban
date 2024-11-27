<?php

namespace App\Infrastructure\Interfaces;

use App\Domain\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
    public function save(User $user): void;
    public function delete(int $id): void;
    public function all(): Collection; // Add this method
    public function create(array $data): User; // Add create method
}
