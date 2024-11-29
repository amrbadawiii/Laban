<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Company;
use App\Infrastructure\Interfaces\ICompanyRepository;

class CompanyRepository implements ICompanyRepository
{
    public function getAll()
    {
        return Company::paginate(10); // Return raw Eloquent collection
    }

    public function getById($id)
    {
        return Company::findOrFail($id); // Return raw Eloquent model
    }

    public function create(array $data)
    {
        return Company::create($data); // Return raw Eloquent model
    }

    public function update($id, array $data)
    {
        $warehouse = Company::findOrFail($id);
        $warehouse->update($data);
        return $warehouse; // Return raw Eloquent model
    }

    public function delete($id)
    {
        $warehouse = Company::findOrFail($id);
        return $warehouse->delete();
    }
}
