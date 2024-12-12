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
        $items = $this->supplierService->getAll()->toArray();
        return view('suppliers.index', compact('items')); // Pass suppliers as an array to the view
    }

    public function show($id)
    {
        $supplier = $this->supplierService->getById($id)->toArray();
        return view('suppliers.show', ['supplier' => $supplier]); // Pass supplier as an array to the view
    }

    public function create()
    {
        return view('suppliers.create'); // Show a form for creating a supplier
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required'
        ]);

        $this->supplierService->create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function edit($id)
    {
        $supplier = $this->supplierService->getById($id)->toArray();
        return view('suppliers.edit', ['supplier' => $supplier]); // Pass supplier as an array to the view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required'
        ]);

        $this->supplierService->update($id, $validated);
        return redirect()->route('suppliers.index')->with('success', 'supplier updated successfully.');
    }

    public function destroy($id)
    {
        $this->supplierService->delete($id);
        return redirect()->route('suppliers.index')->with('success', 'supplier deleted successfully.');
    }
}
