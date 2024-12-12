<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Product;
use App\Infrastructure\Interfaces\IProductRepository;


class ProductRepository extends BaseRepository implements IProductRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Company here if needed
}
