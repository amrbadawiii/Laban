<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'warehouse_id',
        'customer_id',
        'order_id',
        'invoice_number',
        'invoice_date',
        'invoice_status',
        'total_amount',
        'total_price',
        'notes',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'invoice_date' => 'date',
        'total_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'invoice_status' => 'string',
    ];

    /**
     * Relationships
     */

    // Warehouse relationship
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Customer relationship
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Order relationship (nullable)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Created by relationship
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Updated by relationship
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Invoice items relationship
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

}

