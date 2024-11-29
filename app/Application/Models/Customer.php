<?php

namespace App\Application\Models;

class Customer
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $phone;
    private ?string $address;
    private ?string $city;
    private bool $isActive;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone = null,
        ?string $address = null,
        ?string $city = null,
        bool $isActive = true
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->city = $city;
        $this->isActive = $isActive;
    }

    // Magic getter for camelCase access
    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        throw new \Exception("Property '{$property}' does not exist on " . static::class);
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }
}
