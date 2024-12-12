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
        $items = $this->companyService->getAll()->toArray();
        return view('companies.index', compact('items')); // Pass companies as an array to the view
    }

    public function show($id)
    {
        $company = $this->companyService->getById($id)->toArray();
        return view('companies.show', ['company' => $company]); // Pass company as an array to the view
    }

    public function create()
    {
        return view('companies.create'); // Show a form for creating a companies
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'website' => 'required'
        ]);

        $this->companyService->create($validated);
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = $this->companyService->getById($id)->toArray();
        return view('companies.edit', ['company' => $company]); // Pass Company as an array to the view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'website' => 'required'
        ]);

        $this->companyService->update($id, $validated);
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $this->companyService->delete($id);
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
