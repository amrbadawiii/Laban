<?php

namespace App\Application\Services;

use App\Infrastructure\Interfaces\IInboundRepository;
use App\Application\Interfaces\IInboundService;
use App\Application\Models\Inbound;
use Illuminate\Pagination\LengthAwarePaginator;
use DateTime;

class InboundService implements IInboundService
{
    private IInboundRepository $inboundRepository;

    public function __construct(IInboundRepository $inboundRepository)
    {
        $this->inboundRepository = $inboundRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        $inbounds = $this->inboundRepository->getAll();

        // Transform Eloquent models to domain models
        $inbounds->getCollection()->transform(function ($eloquentInbound) {
            return $this->mapToDomainModel($eloquentInbound);
        });

        return $inbounds;
    }

    public function getById(int $id): ?Inbound
    {
        $eloquentInbound = $this->inboundRepository->getById($id);
        if (!$eloquentInbound) {
            return null;
        }

        return $this->mapToDomainModel($eloquentInbound);
    }

    public function create(array $data): Inbound
    {
        $eloquentInbound = $this->inboundRepository->create($data);
        return $this->mapToDomainModel($eloquentInbound);
    }

    public function update(int $id, array $data): Inbound
    {
        $eloquentInbound = $this->inboundRepository->update($id, $data);
        return $this->mapToDomainModel($eloquentInbound);
    }

    public function delete(int $id): bool
    {
        return $this->inboundRepository->delete($id);
    }

    // Private Methods

    private function mapToDomainModel($eloquentInbound): Inbound
    {
        return new Inbound(
            id: $eloquentInbound->id,
            productId: $eloquentInbound->product_id,
            product: $eloquentInbound->product->toArray(),
            measurementUnitId: $eloquentInbound->measurement_unit_id,
            measurementUnit: $eloquentInbound->measurementUnit->toArray(),
            quantity: $eloquentInbound->quantity,
            supplierId: $eloquentInbound->supplier_id,
            supplier: $eloquentInbound->supplier->toArray(),
            warehouseId: $eloquentInbound->warehouse_id,
            warehouse: $eloquentInbound->warehouse->toArray(),
            receivedDate: new DateTime($eloquentInbound->received_date),
            isConfirmed: $eloquentInbound->is_confirmed,
            invoiceNumber: $eloquentInbound->invoice_number
        );
    }
}
