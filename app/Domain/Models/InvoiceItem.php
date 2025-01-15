<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'product_id',
        'measurement_unit_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    /**
     * Relationships
     */

    // Invoice relationship
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Product relationship
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Measurement unit relationship
    public function measurementUnit()
    {
        return $this->belongsTo(MeasurementUnit::class);
    }

}

