<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InboundController extends Controller
{
    private IInboundService $inboundService;
    private IProductService $iProductService;
    private ISupplierService $iSupplierService;
    private IWarehouseService $iWarehouseService;
    private IMeasurementUnitService $iMeasurementUnitService;

    public function __construct(IInboundService $inboundService, IProductService $iProductService, ISupplierService $iSupplierService, IWarehouseService $iWarehouseService, IMeasurementUnitService $iMeasurementUnitService)
    {
        $this->inboundService = $inboundService;
        $this->iProductService = $iProductService;
        $this->iSupplierService = $iSupplierService;
        $this->iWarehouseService = $iWarehouseService;
        $this->iMeasurementUnitService = $iMeasurementUnitService;
    }

    public function index()
    {
        $items = $this->inboundService->getAll();

        //dd($items);
        $items->getCollection()->transform(function ($inbound) {
            return $inbound->toArray();
        });

        return view('inbounds.index', compact('items'));
    }

    public function show(int $id)
    {
        $inbound = $this->inboundService->getById($id)->toArray();
        return view('inbounds.show', compact('inbound'));
    }

    public function create()
    {
        $products = $this->iProductService->getAllProducts();
        $suppliers = $this->iSupplierService->getAllSuppliers();
        $measurementUnits = $this->iMeasurementUnitService->getAllMeasurementUnits();
        $warehouses = $this->iWarehouseService->getAllWarehouses();
        return view('inbounds.create', compact('products', 'suppliers', 'measurementUnits', 'warehouses'));
    }

    public function store(Request $request)
    {
        $validated = $request->merge([
            'is_confirmed' => $request->input('is_confirmed', false),
        ])->validate([
                    'product_id' => 'required|exists:products,id',
                    'measurement_unit_id' => 'required|exists:measurement_units,id',
                    'quantity' => 'required|numeric|min:0.01',
                    'supplier_id' => 'nullable|exists:suppliers,id',
                    'warehouse_id' => 'required|exists:warehouses,id',
                    'received_date' => 'required|date',
                    'is_confirmed' => 'boolean',
                    'invoice_number' => 'nullable|string|max:255',
                ]);

        $inbound = $this->inboundService->create($validated);

        return view('inbounds.show', compact('inbound'));
    }

    public function edit($id)
    {
        $inbound = $this->inboundService->getById($id)->toArray();
        $products = $this->iProductService->getAllProducts();
        $suppliers = $this->iSupplierService->getAllSuppliers();
        $measurementUnits = $this->iMeasurementUnitService->getAllMeasurementUnits();
        $warehouses = $this->iWarehouseService->getAllWarehouses();
        return view('inbounds.edit', compact('inbound', 'products', 'suppliers', 'measurementUnits', 'warehouses'));
    }
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'measurement_unit_id' => 'sometimes|required|exists:measurement_units,id',
            'quantity' => 'sometimes|required|numeric|min:0.01',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'warehouse_id' => 'sometimes|required|exists:warehouses,id',
            'received_date' => 'sometimes|required|date',
            'is_confirmed' => 'boolean',
            'invoice_number' => 'nullable|string|max:255',
        ]);

        $inbound = $this->inboundService->update($id, $validated);

        return view('inbounds.edit', compact('inbound'));
    }

    public function confirm($id)
    {
        try {
            // Update the is_confirmed status
            DB::table('inbounds')->where('id', $id)->update(['is_confirmed' => true]);

            return redirect()->route('inbounds.index')->with('success', __('messages.inbound_confirmed'));
        } catch (\Exception $e) {
            return redirect()->route('inbounds.index')->with('error', __('messages.error_confirming_inbound'));
        }
    }

    public function destroy(int $id)
    {
        $deleted = $this->inboundService->delete($id);

        if (!$deleted) {
            return redirect()->route('inbounds.index');
        }

        return redirect()->route('inbounds.index');
        ;
    }
}
