<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Inbound;
use App\Infrastructure\Interfaces\IInboundRepository;
use Illuminate\Support\Facades\Session;

class InboundRepository extends BaseRepository implements IInboundRepository
{
    public function __construct(Inbound $model)
    {
        parent::__construct($model);
    }

    public function all(array $conditions = [], array $columns = ['*'], array $relations = [], int $perPage = 10)
    {
        // Add default relations specific to Inbound
        $relations = array_merge(['product', 'measurementUnit', 'supplier', 'warehouse'], $relations);

        // Apply role-based filtering
        $conditions = $this->applyRoleBasedConditions($conditions);

        return parent::all($conditions, $columns, $relations, $perPage);
    }

    public function find(int $id, array $columns = ['*'], array $relations = [])
    {
        // Add default relations specific to Inbound
        $relations = array_merge(['product', 'measurementUnit', 'supplier', 'warehouse'], $relations);

        return parent::find($id, $columns, $relations);
    }

    /**
     * Apply role-based conditions based on the session.
     *
     * @param array $conditions
     * @return array
     */
    private function applyRoleBasedConditions(array $conditions): array
    {
        $role = Session::get('role');
        $warehouseId = Session::get('warehouse_id');

        // If role is "0", fetch all data, otherwise filter by warehouse_id
        if ($role !== '0') {
            $conditions['warehouse_id'] = $warehouseId;
        }

        return $conditions;
    }
}
