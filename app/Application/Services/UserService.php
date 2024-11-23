<?php

namespace App\Application\Services\Implementations;

use App\Application\Interfaces\UserServiceInterface;
use App\Domain\Models\User;
use App\Infrastructure\Repositories\UserRepository;
use App\Domain\Enums\UserType;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createAdmin(string $name, string $email, string $password, int $warehouseId): User
    {
        $user = new User(
            id: 0, // ID will be assigned when saved
            name: $name,
            email: $email,
            password: bcrypt($password),
            warehouseId: $warehouseId,
            userType: UserType::Admin
        );

        $this->userRepository->save($user);

        return $user;
    }

    public function createUser(string $name, string $email, string $password, int $warehouseId): User
    {
        $user = new User(
            id: 0,
            name: $name,
            email: $email,
            password: bcrypt($password),
            warehouseId: $warehouseId,
            userType: UserType::User
        );

        $this->userRepository->save($user);

        return $user;
    }
}
