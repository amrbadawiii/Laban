<?php

namespace App\Domain\Models;

use Database\Factories\WarehouseFactory;
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
        return WarehouseFactory::new();
    }

    protected $fillable = [
        'name',
        'location',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
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
