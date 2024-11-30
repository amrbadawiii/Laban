<?php

namespace App\Application\Services;

use App\Application\Interfaces\IProductService;
use App\Application\Models\Product;
use App\Domain\Enums\Type;
use App\Infrastructure\Interfaces\IProductRepository;

class ProductService implements IProductService
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        $products = $this->productRepository->getAll();
        // Transform the collection but keep pagination intact
        $products->getCollection()->transform(function ($product) {
            return $this->mapToDomainModel($product);
        });
        return $products;
    }

    public function getProductById($id)
    {
        $product = $this->productRepository->getById($id);
        return $this->mapToDomainModel($product);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    private function mapToDomainModel($eloquentProduct)
    {
        return new Product(
            $eloquentProduct->id,
            $eloquentProduct->name,
            Type::from($eloquentProduct->type),
        );
    }
}
