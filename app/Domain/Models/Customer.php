<?php

namespace App\Domain\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The factory method declaration.
     *
     * @var string
     */
    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'is_active',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function quotaions()
    {
        return $this->hasMany(Quotation::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
