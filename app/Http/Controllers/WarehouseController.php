<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private IWarehouseService $warehouseService;

    public function __construct(IWarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {

        $items = $this->warehouseService->getAll()->toArray();
        return view('warehouses.index', compact('items')); // Pass warehouses as an array to the view
    }

    public function show($id)
    {
        $warehouse = $this->warehouseService->getById($id)->toArray();
        return view('warehouses.show', ['warehouse' => $warehouse]); // Pass warehouse as an array to the view
    }

    public function create()
    {
        return view('warehouses.create'); // Show a form for creating a warehouse
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:warehouses,name',
            'location' => 'required',
        ]);

        $this->warehouseService->create($validated);
        return redirect()->route('warehouses.index')->with('success', 'Warehouse created successfully.');
    }

    public function edit($id)
    {
        $warehouse = $this->warehouseService->getById($id)->toArray();
        return view('warehouses.edit', ['warehouse' => $warehouse]); // Pass warehouse as an array to the view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:warehouses,name,' . $id,
            'location' => 'required',
        ]);

        $this->warehouseService->update($id, $validated);
        return redirect()->route('warehouses.index')->with('success', 'Warehouse updated successfully.');
    }

    public function destroy($id)
    {
        $this->warehouseService->delete($id);
        return redirect()->route('warehouses.index')->with('success', 'Warehouse deleted successfully.');
    }
}
