<?php

namespace App\Domain\Models;

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
        'credit',
        'debit',
        'warehouse_id',
        'measurement_unit_id',
    ];

    /**
     * Relationship: Stock belongs to a Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: Stock belongs to a Warehouse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Relationship: Stock belongs to a MeasurementUnit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }
}
