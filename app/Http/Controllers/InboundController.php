<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    private IInboundService $inboundService;
    private IProductService $productService;
    private IMeasurementUnitService $measurementUnitService;
    private ISupplierService $supplierService;
    private IWarehouseService $warehouseService;

    public function __construct(IInboundService $inboundService, IProductService $productService, IMeasurementUnitService $measurementUnitService, ISupplierService $supplierService, IWarehouseService $warehouseService)
    {
        $this->inboundService = $inboundService;
        $this->productService = $productService;
        $this->measurementUnitService = $measurementUnitService;
        $this->supplierService = $supplierService;
        $this->warehouseService = $warehouseService;
    }

    /**
     * Display a listing of the inbounds.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $items = $this->inboundService->getAll(['*'], ['product', 'measurementUnit', 'supplier', 'warehouse'])->toArray();
        return view('inbounds.index', compact('items'));
    }

    /**
     * Show the form for creating a new inbound.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $products = $this->productService->getAll()->toArray();
        $measurementUnits = $this->measurementUnitService->getAll()->toArray();
        $suppliers = $this->supplierService->getAll()->toArray();
        $warehouses = $this->warehouseService->getAll()->toArray();
        //dd($products);
        return view('inbounds.create', compact('products', 'measurementUnits', 'suppliers', 'warehouses'));
    }

    /**
     * Store a newly created inbound in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'measurement_unit_id' => 'required|exists:measurement_units,id',
            'quantity' => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'received_date' => 'required|date',
            'is_confirmed' => 'boolean',
            'invoice_number' => 'nullable|string|max:255',
        ]);

        $this->inboundService->create($data);

        return redirect()->route('inbounds.index')->with('success', __('Inbound created successfully.'));
    }

    /**
     * Display the specified inbound.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $inbound = $this->inboundService->getById($id, ['product', 'measurementUnit', 'supplier', 'warehouse'])->toArray();
        //dd($inbound);
        return view('inbounds.show', compact('inbound'));
    }

    /**
     * Show the form for editing the specified inbound.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $inbound = $this->inboundService->getById($id)->toArray();
        $products = $this->productService->getAll()->toArray();
        $measurementUnits = $this->measurementUnitService->getAll()->toArray();
        $suppliers = $this->supplierService->getAll()->toArray();
        $warehouses = $this->warehouseService->getAll()->toArray();
        //dd($inbound, $measurementUnits);
        return view('inbounds.edit', compact('inbound', 'products', 'measurementUnits', 'suppliers', 'warehouses'));
    }

    /**
     * Update the specified inbound in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'measurement_unit_id' => 'required|exists:measurement_units,id',
            'quantity' => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'received_date' => 'required|date',
            'is_confirmed' => 'boolean',
            'invoice_number' => 'nullable|string|max:255',
        ]);

        $this->inboundService->update($id, $data);

        return redirect()->route('inbounds.index')->with('success', __('Inbound updated successfully.'));
    }

    /**
     * Remove the specified inbound from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->inboundService->delete($id);

        return redirect()->route('inbounds.index')->with('success', __('Inbound deleted successfully.'));
    }
}
