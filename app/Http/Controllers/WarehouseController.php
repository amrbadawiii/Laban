<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    private $warehouseService;

    public function __construct(IWarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function index()
    {
        $items = $this->warehouseService->getAllWarehouses();
        return view('warehouses.index', compact('items')); // Pass warehouses to the view
    }

    public function show($id)
    {
        $warehouse = $this->warehouseService->getWarehouseById($id);
        return view('warehouses.show', compact('warehouse')); // Pass a single warehouse to the view
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

        $this->warehouseService->createWarehouse($validated);
        return redirect()->route('warehouses.index')->with('success', 'Warehouse created successfully.');
    }

    public function edit($id)
    {
        $warehouse = $this->warehouseService->getWarehouseById($id);
        return view('warehouses.edit', compact('warehouse')); // Show a form for editing a warehouse
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:warehouses,name,' . $id,
            'location' => 'required',
        ]);

        $this->warehouseService->updateWarehouse($id, $validated);
        return redirect()->route('warehouses.index')->with('success', 'Warehouse updated successfully.');
    }

    public function destroy($id)
    {
        $this->warehouseService->deleteWarehouse($id);
        return redirect()->route('warehouses.index')->with('success', 'Warehouse deleted successfully.');
    }
}
