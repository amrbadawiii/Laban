<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Product;
use App\Infrastructure\Interfaces\IProductRepository;

class ProductRepository implements IProductRepository
{
    public function getAll()
    {
        return Product::paginate(10); // Return raw Eloquent collection
    }

    public function getById($id)
    {
        return Product::findOrFail($id); // Return raw Eloquent model
    }

    public function create(array $data)
    {
        return Product::create($data); // Return raw Eloquent model
    }

    public function update($id, array $data)
    {
        $warehouse = Product::findOrFail($id);
        $warehouse->update($data);
        return $warehouse; // Return raw Eloquent model
    }

    public function delete($id)
    {
        $warehouse = Product::findOrFail($id);
        return $warehouse->delete();
    }
}
