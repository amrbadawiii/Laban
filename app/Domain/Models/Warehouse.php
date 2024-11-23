<?php

namespace App\Domain\Models;

class Warehouse
{
    private int $id;
    private string $name;
    private string $location;

    public function __construct(int $id, string $name, string $location)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
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

    public function getLocation(): string
    {
        return $this->location;
    }

    // Business logic
    public function updateLocation(string $newLocation): void
    {
        // Add validation logic if necessary
        $this->location = $newLocation;
    }
}
