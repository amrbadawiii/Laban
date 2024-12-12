<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Company;
use App\Infrastructure\Interfaces\ICompanyRepository;

class CompanyRepository extends BaseRepository implements ICompanyRepository
{
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    // Add custom methods specific to Company here if needed
}
