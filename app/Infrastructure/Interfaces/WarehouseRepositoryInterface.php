<?php

namespace App\Infrastructure\Interfaces;

use App\Domain\Models\Warehouse;
use Illuminate\Support\Collection;

interface WarehouseRepositoryInterface
{
    /**
     * Retrieve all warehouses.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Find a warehouse by ID.
     *
     * @param int $id
     * @return Warehouse|null
     */
    public function findById(int $id): ?Warehouse;

    /**
     * Create a new warehouse.
     *
     * @param array $data
     * @return Warehouse
     */
    public function create(array $data): Warehouse;

    /**
     * Update a warehouse.
     *
     * @param Warehouse $warehouse
     * @return void
     */
    public function update(Warehouse $warehouse): void;

    /**
     * Delete a warehouse by ID.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
