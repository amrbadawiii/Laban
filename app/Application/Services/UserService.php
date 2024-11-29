<?php

namespace App\Application\Services;

use App\Application\Interfaces\UserServiceInterface;
use App\Infrastructure\Interfaces\UserRepositoryInterface;
use App\Domain\Enums\UserType;
use App\Application\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Retrieve all registered users.
     *
     * @return Collection
     */
    public function getAllUsers(): Collection
    {
        return $this->userRepository->all();
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        // Ensure the authenticated user is an admin
        $authenticatedUser = Auth::users();
        if (!$authenticatedUser || $authenticatedUser->user_type !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Create the user via repository
        return $this->userRepository->create($data);
    }
}
