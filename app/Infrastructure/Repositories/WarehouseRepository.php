<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Interfaces\WarehouseRepositoryInterface;
use App\Infrastructure\Models\Warehouse as EloquentWarehouse;
use App\Domain\Models\Warehouse as DomainWarehouse;
use Illuminate\Support\Collection;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function all(): Collection
    {
        return EloquentWarehouse::all()->map(function ($eloquentWarehouse) {
            return $this->toDomainModel($eloquentWarehouse);
        });
    }

    public function findById(int $id): ?DomainWarehouse
    {
        $eloquentWarehouse = EloquentWarehouse::find($id);
        return $eloquentWarehouse ? $this->toDomainModel($eloquentWarehouse) : null;
    }

    public function create(array $data): DomainWarehouse
    {
        $eloquentWarehouse = EloquentWarehouse::create($data);
        return $this->toDomainModel($eloquentWarehouse);
    }

    public function update(DomainWarehouse $warehouse): void
    {
        $eloquentWarehouse = EloquentWarehouse::findOrFail($warehouse->getId());
        $eloquentWarehouse->name = $warehouse->getName();
        $eloquentWarehouse->location = $warehouse->getLocation();
        $eloquentWarehouse->save();
    }

    public function delete(int $id): void
    {
        EloquentWarehouse::destroy($id);
    }

    private function toDomainModel(EloquentWarehouse $eloquentWarehouse): DomainWarehouse
    {
        return new DomainWarehouse(
            id: $eloquentWarehouse->id,
            name: $eloquentWarehouse->name,
            location: $eloquentWarehouse->location
        );
    }
}
