<?php

namespace App\Application\Models;

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

    // Magic method to dynamically access private properties
    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        throw new \Exception("Property '{$property}' does not exist on " . static::class);
    }

    // Magic method to check if a property exists
    public function __isset(string $property): bool
    {
        return property_exists($this, $property);
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
}
