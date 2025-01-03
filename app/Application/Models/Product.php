<?php

namespace App\Application\Models;

use App\Domain\Enums\Type;

class Product
{
    private int $id;
    private string $name;
    private Type $type;

    public function __construct(int $id, string $name, Type $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Check if the product is a raw material.
     *
     * @return bool
     */
    public function isRaw(): bool
    {
        return $this->type === Type::Row;
    }

    /**
     * Check if the product is a final product.
     *
     * @return bool
     */
    public function isFinalProduct(): bool
    {
        return $this->type === Type::Product;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type
        ];
    }
}
