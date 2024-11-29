<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ISupplierService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private ISupplierService $supplierService;

    public function __construct(ISupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    public function index()
    {
        $items = $this->supplierService->getAllSuppliers();
        return view('suppliers.index', compact('items'));
    }

    public function show($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);
        return view('suppliers.show', compact('supplier'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:suppliers',
            'phone' => 'nullable|string|max:20|unique:suppliers',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $this->supplierService->createSupplier($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function edit($id)
    {
        $supplier = $this->supplierService->getSupplierById($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:suppliers,email,' . $id,
            'phone' => 'nullable|string|max:20|unique:suppliers,phone,' . $id,
            'address' => 'nullable|string',
            'city' => 'nullable|string',
        ]);

        $this->supplierService->updateSupplier($id, $validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        $this->supplierService->deleteSupplier($id);
        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
