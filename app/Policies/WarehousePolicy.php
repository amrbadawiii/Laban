<?php

namespace App\Policies;

use App\Domain\Enums\UserType;
use App\Infrastructure\Models\User;
use App\Infrastructure\Models\Warehouse;

class WarehousePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Warehouse $warehouse)
    {
        if ($user->user_type === UserType::Admin->value) {
            return true; // Admin can access all warehouses
        }

        return $user->warehouse_id === $warehouse->id;
    }

}
