<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IWarehouseService;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    protected IInboundService $inboundService;
    protected IWarehouseService $warehouseService;
    protected ISupplierService $supplierService;

    public function __construct(IInboundService $inboundService, IWarehouseService $warehouseService, ISupplierService $supplierService)
    {
        $this->inboundService = $inboundService;
        $this->warehouseService = $warehouseService;
        $this->supplierService = $supplierService;
    }

    public function index(Request $request)
    {
        $usePopup = true;
        $title = 'Inbound';
        $action = route('inbounds.store');
        $warehouse = $this->warehouseService->getAllWoP([], ['id', 'name'])->toArray();
        $supplier = $this->supplierService->getAllWoP([], ['id', 'name'])->toArray();
        $warehouses = [];
        $suppliers = [];
        foreach ($warehouse as $item) {
            $warehouses[$item['id']] = $item['name'];
        }
        foreach ($supplier as $item) {
            $suppliers[$item['id']] = $item['name'];
        }
        $inputs = [
            ['name' => 'reference_number', 'type' => 'text', 'label' => 'Reference Number', 'required' => true],
            ['name' => 'supplier_id', 'type' => 'select', 'label' => 'Supplier', 'required' => true, 'options' => $suppliers],
            ['name' => 'warehouse_id', 'type' => 'select', 'label' => 'Warehouse', 'required' => true, 'options' => $warehouses],
            ['name' => 'received_date', 'type' => 'date', 'label' => 'Received Date', 'required' => true],
            ['name' => 'is_confirmed', 'type' => 'text', 'label' => 'Is Confirmed', 'required' => true],
            ['name' => 'invoice_number', 'type' => 'text', 'label' => 'Invoice Number', 'required' => false],
        ];
        $conditions = $request->only(['supplier_id', 'warehouse_id', 'is_confirmed']);
        $items = $this->inboundService->getAll($conditions, ['*'], ['supplier', 'warehouse', 'items.product']);
        return view('inbounds.index', compact('items', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function show(int $id)
    {
        $inbound = $this->inboundService->getById($id, ['supplier', 'warehouse', 'items.product']);
        return view('inbounds.show', compact('inbound'));
    }

    public function create()
    {
        return view('inbounds.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->inboundService->create($data);
        return redirect()->route('inbounds.index')->with('success', 'Inbound created successfully.');
    }

    public function edit(int $id)
    {
        $inbound = $this->inboundService->getById($id, ['items']);
        return view('inbounds.edit', compact('inbound'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->all();
        $this->inboundService->update($id, $data);
        return redirect()->route('inbounds.index')->with('success', 'Inbound updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->inboundService->delete($id);
        return redirect()->route('inbounds.index')->with('success', 'Inbound deleted successfully.');
    }

    public function confirm(int $id)
    {
        $this->inboundService->confirmInbound($id);
        return redirect()->route('inbounds.index')->with('success', 'Inbound confirmed successfully.');
    }
}
