<?php

namespace App\Domain\Models;

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

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function inbounds()
    {
        return $this->hasMany(Inbound::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
