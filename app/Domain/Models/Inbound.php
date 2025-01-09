<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_number',
        'supplier_id',
        'warehouse_id',
        'received_date',
        'is_confirmed',
        'invoice_number',
        'created_by',
        'updated_by',
    ];

    // Relationships


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inboundItems()
    {
        return $this->hasMany(InboundItem::class);
    }
}
