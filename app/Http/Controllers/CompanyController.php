<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ICompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private ICompanyService $companyService;

    public function __construct(ICompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        $items = $this->companyService->getAllCompanies();
        return view('companies.index', compact('items'));
    }

    public function show($id)
    {
        $company = $this->companyService->getCompanyById($id);
        return view('companies.show', compact('company'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        $this->companyService->createCompany($validated);
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = $this->companyService->getCompanyById($id);
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        $this->companyService->updateCompany($id, $validated);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $this->companyService->deleteCompany($id);
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
