<?php

namespace App\Application\Interfaces;

use App\Application\Models\Inbound;
use Illuminate\Pagination\LengthAwarePaginator;

interface IInboundService extends IBaseService
{
    public function confirmInbound(int $id): Inbound;
}
