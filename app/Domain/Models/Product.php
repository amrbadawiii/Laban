<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The factory method declaration.
     *
     * @var string
     */
    protected static function newFactory()
    {
        return \Database\Factories\ProductFactory::new();
    }

    protected $fillable = [
        'name',
        'type',
    ];

    // Accessor for the "type" attribute
    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function inbounds()
    {
        return $this->hasMany(Inbound::class);
    }
}
