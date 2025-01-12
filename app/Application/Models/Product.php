<?php

namespace App\Application\Models;

use App\Domain\Enums\Type;

class Product
{
    private int $id;
    private string $name;
    private bool $isProduction;
    private bool $isSelling;

    public function __construct(
        int $id,
        string $name,
        bool $isProduction,
        bool $isSelling
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->isProduction = $isProduction;
        $this->isSelling = $isSelling;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getIsProduction()
    {
        return $this->isProduction;
    }
    public function getIsSelling()
    {
        return $this->isSelling;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_production' => $this->isProduction,
            'is_selling' => $this->isSelling,
        ];
    }
}
