<?php

namespace App\Application\Services;

use App\Application\Interfaces\ISupplierService;
use App\Application\Models\Supplier;
use App\Infrastructure\Interfaces\ISupplierRepository;

class SupplierService implements ISupplierService
{
    private ISupplierRepository $supplierRepository;

    public function __construct(ISupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getAllSuppliers()
    {
        $suppliers = $this->supplierRepository->getAll();
        // Transform the collection but keep pagination intact
        $suppliers->getCollection()->transform(function ($supplier) {
            return $this->mapToDomainModel($supplier);
        });
        return $suppliers;
    }

    public function getSupplierById($id)
    {
        $supplier = $this->supplierRepository->getById($id);
        return $this->mapToDomainModel($supplier);
    }

    public function createSupplier(array $data)
    {
        return $this->supplierRepository->create($data);
    }

    public function updateSupplier($id, array $data)
    {
        return $this->supplierRepository->update($id, $data);
    }

    public function deleteSupplier($id)
    {
        return $this->supplierRepository->delete($id);
    }

    private function mapToDomainModel($eloquentSupplier)
    {
        return new Supplier(
            $eloquentSupplier->id,
            $eloquentSupplier->name,
            $eloquentSupplier->email,
            $eloquentSupplier->phone,
            $eloquentSupplier->address,
            $eloquentSupplier->city,
            $eloquentSupplier->is_active
        );
    }
}
