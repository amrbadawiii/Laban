<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\IStockService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    private IInboundService $inboundService;
    private array $relations = ['product', 'measurementUnit', 'supplier', 'warehouse'];
    private array $columns = ['*'];
    private array $conditions = [];
    private IWarehouseService $warehouseService;
    private IMeasurementUnitService $measurementUnitService;
    private IProductService $productService;
    private ISupplierService $supplierService;
    private IStockService $stockService;

    public function __construct(IInboundService $inboundService, IWarehouseService $warehouseService, IMeasurementUnitService $measurementUnitService, IProductService $productService, ISupplierService $supplierService, IStockService $stockService)
    {
        $this->inboundService = $inboundService;
        $this->warehouseService = $warehouseService;
        $this->measurementUnitService = $measurementUnitService;
        $this->productService = $productService;
        $this->supplierService = $supplierService;
        $this->stockService = $stockService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = $this->inboundService->getAll($this->conditions, $this->columns, $this->relations)->toArray();

        return view('inbounds.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouses = $this->warehouseService->getAllWoP()->toArray();
        $measurementUnits = $this->measurementUnitService->getAllWoP()->toArray();
        $products = $this->productService->getAllWoP()->toArray();
        $suppliers = $this->supplierService->getAllWoP()->toArray();
        return view('inbounds.create', compact('warehouses', 'measurementUnits', 'products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'measurement_unit_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'supplier_id' => 'nullable|integer',
            'warehouse_id' => 'required|integer',
            'received_date' => 'required|date',
            'is_confirmed' => 'boolean',
            'invoice_number' => 'nullable|string',
        ]);

        $this->inboundService->create($validated);

        return redirect()->route('inbounds.index')->with('success', 'Inbound created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $inbound = $this->inboundService->getById($id, $this->relations)->toArray();

        return view('inbounds.show', compact('inbound'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $inbound = $this->inboundService->getById($id);
        $warehouses = $this->warehouseService->getAllWoP()->toArray();
        $measurementUnits = $this->measurementUnitService->getAllWoP()->toArray();
        $products = $this->productService->getAllWoP()->toArray();
        $suppliers = $this->supplierService->getAllWoP()->toArray();

        return view('inbounds.edit', compact('inbound', 'warehouses', 'measurementUnits', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|integer',
            'measurement_unit_id' => 'nullable|integer',
            'quantity' => 'nullable|numeric',
            'supplier_id' => 'nullable|integer',
            'warehouse_id' => 'nullable|integer',
            'received_date' => 'nullable|date',
            'is_confirmed' => 'nullable|boolean',
            'invoice_number' => 'nullable|string',
        ]);

        $this->inboundService->update($id, $validated);

        return redirect()->route('inbounds.index')->with('success', 'Inbound updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->inboundService->delete($id);

        return redirect()->route('inbounds.index')->with('success', 'Inbound deleted successfully.');
    }

    /**
     * Confirm an inbound record.
     */
    public function confirm(int $id)
    {
        // Confirm the inbound transaction
        $this->inboundService->confirmInbound($id);

        // Fetch inbound details (assuming the method exists)
        $inbound = $this->inboundService->getById($id);

        // Prepare data for the stock service
        $data = [
            'product_id' => $inbound->product_id,
            'warehouse_id' => $inbound->warehouse_id,
            'credit' => $inbound->quantity, // Quantity received increases stock
            'debit' => 0, // No outgoing stock for inbound
            'measurement_unit_id' => $inbound->measurement_unit_id,
        ];

        // Add the stock entry
        $this->stockService->create($data);

        // Redirect back with a success message
        return redirect()->route('inbounds.index')->with('success', 'Inbound confirmed and stock updated successfully.');
    }


    /**
     * Filter by date range.
     */
    public function filterByDateRange(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $relations = $request->query('relations', []);
        $inbounds = $this->inboundService->filterByDateRange($validated['start_date'], $validated['end_date'], $relations);

        return view('inbounds.index', compact('inbounds'));
    }

    /**
     * Search by invoice number.
     */
    public function searchByInvoice(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string',
        ]);

        $relations = $request->query('relations', []);
        $inbound = $this->inboundService->getByInvoiceNumber($validated['invoice_number'], $relations);

        if (!$inbound) {
            return redirect()->route('inbounds.index')->with('error', 'Inbound not found.');
        }

        return view('inbounds.show', compact('inbound'));
    }
}
