<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model
{
    use HasFactory;

    /**
     * The factory method declaration.
     *
     * @var string
     */
    protected static function newFactory()
    {
        return \Database\Factories\MeasurementUnitFactory::new();
    }

    protected $fillable = [
        'name_en',
        'name_ar',
        'abbreviation'
    ];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function inboundItems()
    {
        return $this->hasMany(InboundItem::class);
    }

}
