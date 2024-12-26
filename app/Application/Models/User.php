<?php

namespace App\Application\Models;

use App\Domain\Enums\UserType;
use App\Domain\Models\Warehouse;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private int $warehouseId;
    private UserType $userType;
    private ?Warehouse $warehouse; // Optional Warehouse object

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $password,
        int $warehouseId,
        UserType $userType,
        ?Warehouse $warehouse = null // Accept a Warehouse object
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->warehouseId = $warehouseId;
        $this->userType = $userType;
        $this->warehouse = $warehouse;
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

    public function getWarehouse(): ?Warehouse
    {
        return $this->warehouse;
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

    // Convert the user and associated warehouse to an array
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'warehouseId' => $this->warehouseId,
            'userTypeName' => $this->userType->name,
            'userTypeValue' => $this->userType->value,
            'warehouse' => $this->warehouse ? $this->warehouse->toArray() : null, // Include warehouse details
        ];
    }
}
