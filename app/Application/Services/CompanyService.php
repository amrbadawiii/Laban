<?php

namespace App\Application\Services;

use App\Application\Interfaces\ICompanyService;
use App\Application\Models\Company;
use App\Infrastructure\Interfaces\ICompanyRepository;

class CompanyService implements ICompanyService
{
    private ICompanyRepository $companyRepository;

    public function __construct(ICompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAllCompanies()
    {
        $companies = $this->companyRepository->getAll();
        // Transform the collection but keep pagination intact
        $companies->getCollection()->transform(function ($company) {
            return $this->mapToDomainModel($company);
        });
        return $companies;
    }

    public function getCompanyById($id)
    {
        $company = $this->companyRepository->getById($id);
        return $this->mapToDomainModel($company);
    }

    public function createCompany(array $data)
    {
        return $this->companyRepository->create($data);
    }

    public function updateCompany($id, array $data)
    {
        return $this->companyRepository->update($id, $data);
    }

    public function deleteCompany($id)
    {
        return $this->companyRepository->delete($id);
    }

    private function mapToDomainModel($eloquentCompany)
    {
        return new Company(
            $eloquentCompany->id,
            $eloquentCompany->name,
            $eloquentCompany->email,
            $eloquentCompany->phone,
            $eloquentCompany->address,
            $eloquentCompany->website,
            $eloquentCompany->is_active
        );
    }
}
