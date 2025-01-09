<?php

namespace App\Domain\Models;

use Database\Factories\SupplierFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The factory method declaration.
     *
     * @var string
     */
    protected static function newFactory()
    {
        return SupplierFactory::new();
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'is_active'
    ];

    public function inbounds()
    {
        return $this->hasMany(Inbound::class);
    }
}
