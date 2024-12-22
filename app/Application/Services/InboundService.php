<?php

namespace App\Application\Services;

use App\Application\Interfaces\IInboundService;
use App\Application\Models\Inbound;
use App\Application\Models\MeasurementUnit;
use App\Application\Models\Product;
use App\Application\Models\Supplier;
use App\Application\Models\Warehouse;
use App\Domain\Enums\Type;
use App\Infrastructure\Interfaces\IInboundRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DateTime;

class InboundService implements IInboundService
{
    /**
     * @var IInboundRepository
     */
    protected $repository;

    /**
     * InboundService constructor.
     *
     * @param IInboundRepository $repository
     */
    public function __construct(IInboundRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retrieve all inbounds with optional columns and relations.
     *
     * @param array $columns
     * @param array $relations
     * @return array
     */
    public function getAll(array $columns = ['*'], array $relations = []): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $eloquentInbounds = $this->repository->all($columns, $relations);

        // Map Eloquent models to Domain models
        $domainModels = $eloquentInbounds->getCollection()->map(function ($eloquentInbound) {
            return $this->mapToDomainModel($eloquentInbound);
        });

        // Replace the collection in the paginator with the mapped domain models
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $domainModels,
            $eloquentInbounds->total(),
            $eloquentInbounds->perPage(),
            $eloquentInbounds->currentPage(),
            ['path' => $eloquentInbounds->path()]
        );
    }


    /**
     * Retrieve a specific inbound by ID with relations.
     *
     * @param int $id
     * @param array $relations
     * @return Inbound
     * @throws ModelNotFoundException
     */
    public function getById(int $id, array $relations = []): Inbound
    {
        $eloquentInbound = $this->repository->find($id, ['*'], $relations);

        // Map Eloquent model to Domain model
        return $this->mapToDomainModel($eloquentInbound);
    }

    /**
     * Create a new inbound record.
     *
     * @param array $data
     * @return Inbound
     */
    public function create(array $data): Inbound
    {
        $eloquentInbound = $this->repository->create($data);
        $inbound = $this->repository->find($eloquentInbound->id);
        // Map Eloquent model to Domain model
        return $this->mapToDomainModel($inbound);
    }

    /**
     * Update an existing inbound record.
     *
     * @param int $id
     * @param array $data
     * @return Inbound
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data): Inbound
    {
        $eloquentInbound = $this->repository->update($id, $data);

        // Map Eloquent model to Domain model
        return $this->mapToDomainModel($eloquentInbound);
    }

    /**
     * Delete an inbound record.
     *
     * @param int $id
     * @return bool
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Confirm an inbound record by setting is_confirmed to true.
     *
     * @param int $id
     * @return Inbound
     * @throws ModelNotFoundException
     */
    public function confirmInbound(int $id): Inbound
    {
        // Retrieve the inbound record
        $eloquentInbound = $this->repository->find($id);

        if (!$eloquentInbound) {
            throw new ModelNotFoundException("Inbound record not found with ID: $id");
        }

        // Update the is_confirmed field
        $eloquentInbound->is_confirmed = true;
        $eloquentInbound->save();

        // Map the updated Eloquent model to the Domain model
        return $this->mapToDomainModel($eloquentInbound);
    }

    /**
     * Map Eloquent model to Domain model.
     *
     * @param object $eloquentInbound
     * @return \App\Application\Models\Inbound
     */
    private function mapToDomainModel(\App\Domain\Models\Inbound $eloquentModel): Inbound
    {
        $productDomainModel = new Product(
            $eloquentModel->product->id,
            $eloquentModel->product->name,
            Type::from($eloquentModel->product->type),
            // Add other necessary fields here
        );

        $measurementUnitDomainModel = new MeasurementUnit(
            $eloquentModel->measurementUnit->id,
            $eloquentModel->measurementUnit->name_en,
            $eloquentModel->measurementUnit->name_ar
        );

        $supplierDomainModel = new Supplier(
            $eloquentModel->supplier->id,
            $eloquentModel->supplier->name,
            $eloquentModel->supplier->email,
            $eloquentModel->supplier->phone,
            $eloquentModel->supplier->address,
            $eloquentModel->supplier->city,
            $eloquentModel->supplier->is_active
        );

        $warehouseDomainModel = new Warehouse(
            $eloquentModel->warehouse->id,
            $eloquentModel->warehouse->name,
            $eloquentModel->warehouse->location
        );

        return new Inbound(
            $eloquentModel->id,
            $eloquentModel->product_id,
            $productDomainModel,
            $eloquentModel->measurement_unit_id,
            $measurementUnitDomainModel,
            $eloquentModel->quantity,
            $eloquentModel->supplier_id,
            $supplierDomainModel,
            $eloquentModel->warehouse_id,
            $warehouseDomainModel,
            new DateTime($eloquentModel->received_date),
            $eloquentModel->is_confirmed,
            $eloquentModel->invoice_number
        );
    }

}
