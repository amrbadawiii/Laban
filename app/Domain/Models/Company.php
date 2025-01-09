<?php

namespace App\Domain\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The factory method declaration.
     *
     * @var string
     */
    protected static function newFactory()
    {
        return CompanyFactory::new();
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'website',
        'is_active',
    ];
}
