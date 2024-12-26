<?php

namespace App\Application\Models;

class Company
{
    private int $id;
    private string $name;
    private string $email;
    private ?string $phone;
    private ?string $address;
    private ?string $website;
    private ?bool $isActive;

    public function __construct(
        int $id,
        string $name,
        string $email,
        ?string $phone,
        ?string $address,
        ?string $website,
        ?bool $isActive
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->website = $website;
        $this->isActive = $isActive;
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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'website' => $this->website,
            'isActive' => $this->isActive
        ];
    }
}
