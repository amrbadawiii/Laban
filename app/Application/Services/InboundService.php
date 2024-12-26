<?php

namespace App\Application\Services;

use App\Application\Interfaces\IInboundService;
use App\Application\Models\Inbound;
use App\Infrastructure\Interfaces\IInboundRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class InboundService implements IInboundService
{
    protected IInboundRepository $repository;

    public function __construct(IInboundRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $eloquentCollection = $this->repository->allWoP($conditions, $columns, $relations);
        return $eloquentCollection;
    }

    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $eloquentCollection = $this->repository->all($conditions, $columns, $relations);
        return $eloquentCollection;
    }

    public function getById(int $id, array $relations = [])
    {
        $eloquentModel = $this->repository->find($id, ['*'], $relations);
        return $eloquentModel;
    }

    public function create(array $data): object
    {
        $eloquentModel = $this->repository->create($data);
        return $this->mapToApplicationModel($eloquentModel);
    }

    public function update(int $id, array $data): object
    {
        $eloquentModel = $this->repository->update($id, $data);
        return $this->mapToApplicationModel($eloquentModel);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        $eloquentCollection = $this->repository->customQuery(function ($query) use ($criteria) {
            foreach ($criteria as $column => $value) {
                $query->where($column, $value);
            }
        });
        return array_map([$this, 'mapToApplicationModel'], $eloquentCollection);
    }

    public function confirmInbound(int $id): bool
    {
        $inbound = $this->repository->find($id);
        if (!$inbound) {
            throw new ModelNotFoundException('Inbound not found');
        }

        $updated = $this->repository->update($id, ['is_confirmed' => true]);
        return (bool) $updated;
    }

    public function filterByDateRange(string $startDate, string $endDate, array $relations = []): array
    {
        $eloquentCollection = $this->repository->customQuery(function ($query) use ($startDate, $endDate) {
            $query->whereBetween('received_date', [$startDate, $endDate]);
        });

        return array_map([$this, 'mapToApplicationModel'], $eloquentCollection);
    }

    public function getByInvoiceNumber(string $invoiceNumber, array $relations = []): ?object
    {
        $inbound = $this->repository->customQuery(function ($query) use ($invoiceNumber) {
            $query->where('invoice_number', $invoiceNumber);
        });

        return $inbound ? $this->mapToApplicationModel($inbound->first()) : null;
    }

    /**
     * Map Eloquent model to Application model
     */
    private function mapToApplicationModel($eloquentModel): Inbound
    {
        if (!$eloquentModel) {
            throw new ModelNotFoundException('Inbound not found');
        }

        return new Inbound(
            $eloquentModel->id,
            $eloquentModel->product_id,
            $eloquentModel->product, // Assuming Product is already an application model
            $eloquentModel->measurement_unit_id,
            $eloquentModel->measurementUnit, // Assuming MeasurementUnit is already an application model
            $eloquentModel->quantity,
            $eloquentModel->supplier_id,
            $eloquentModel->supplier, // Assuming Supplier is already an application model
            $eloquentModel->warehouse_id,
            $eloquentModel->warehouse, // Assuming Warehouse is already an application model
            new \DateTime($eloquentModel->received_date),
            $eloquentModel->is_confirmed,
            $eloquentModel->invoice_number
        );
    }
}
