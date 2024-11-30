<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'measurement_unit_id',
        'quantity',
        'supplier_id',
        'warehouse_id',
        'received_date',
        'is_confirmed',
        'invoice_number',
    ];

    /**
     * Relationship: Inbound belongs to a Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relationship: Inbound belongs to a Supplier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Relationship: Inbound belongs to a Warehouse.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Relationship: Inbound belongs to a MeasurementUnit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }
}
