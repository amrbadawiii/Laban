<?php
namespace App\Infrastructure\Repositories;

use App\Domain\Models\Inbound;
use App\Infrastructure\Interfaces\IInboundRepository;

class InboundRepository extends BaseRepository implements IInboundRepository
{
    public function __construct(Inbound $model)
    {
        parent::__construct($model);
    }

    public function all(array $columns = ['*'], array $relations = [], int $perPage = 10)
    {
        // Add default relations specific to Inbound
        $relations = array_merge(['product', 'measurementUnit', 'supplier', 'warehouse'], $relations);
        return parent::all($columns, $relations, $perPage);
    }

    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        // Add default relations specific to Inbound
        $relations = array_merge(['product', 'measurementUnit', 'supplier', 'warehouse'], $relations);
        return parent::find($id, $columns, $relations);
    }
}
