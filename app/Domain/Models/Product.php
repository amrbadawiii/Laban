<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_production',
        'is_selling',
    ];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function inboundItems()
    {
        return $this->hasMany(InboundItem::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
