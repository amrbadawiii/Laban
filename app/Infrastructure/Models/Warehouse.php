<?php

namespace App\Infrastructure\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    /**
     * The factory method declaration.
     *
     * @var string
     */
    protected static function newFactory()
    {
        return \Database\Factories\WarehouseFactory::new();
    }

    protected $fillable = [
        'name',
        'location',
    ];
}
