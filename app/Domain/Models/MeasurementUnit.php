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

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function inbounds()
    {
        return $this->hasMany(Inbound::class);
    }

}
