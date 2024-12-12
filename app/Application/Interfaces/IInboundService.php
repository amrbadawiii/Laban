<?php

namespace App\Application\Interfaces;

use App\Application\Models\Inbound;
use Illuminate\Pagination\LengthAwarePaginator;

interface IInboundService
{
    public function getAll(): LengthAwarePaginator;
    public function getById(int $id): ?Inbound;
    public function create(array $data): Inbound;
    public function update(int $id, array $data): Inbound;
    public function delete(int $id): bool;
}
