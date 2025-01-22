<?php

namespace App\Domain\Models;

use App\Domain\Enums\StatusEnum;
use App\Domain\Enums\StockTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'warehouse_id',
        'measurement_unit_id',
        'incoming',
        'outgoing',
        'stock_type',
        'reference_type',
        'reference_id',
    ];

    /**
     * Relationship: Stock belongs to a Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: Stock belongs to a Warehouse.
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Relationship: Stock belongs to a MeasurementUnit.
     */
    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }

    /**
     * Polymorphic Relationship: Stock reference.
     */
    public function reference()
    {
        return $this->morphTo();
    }
}
