<?php

namespace App\Application\Models;

use App\Domain\Enums\UserType;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private int $warehouseId;
    private UserType $userType;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $password,
        int $warehouseId,
        UserType $userType
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->warehouseId = $warehouseId;
        $this->userType = $userType;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getWarehouseId(): int
    {
        return $this->warehouseId;
    }

    public function getUserType(): UserType
    {
        return $this->userType;
    }

    // Business logic
    public function isAdmin(): bool
    {
        return $this->userType === UserType::Admin;
    }

    public function changePassword(string $newPassword): void
    {
        // Add any necessary validation rules for password changes
        $this->password = $newPassword;
    }
}
