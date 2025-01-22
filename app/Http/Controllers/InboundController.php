<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\IStockService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IWarehouseService;
use App\Domain\Enums\StockTypeEnum;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    protected IInboundService $inboundService;
    protected IWarehouseService $warehouseService;
    protected ISupplierService $supplierService;
    protected IProductService $productService;
    protected IMeasurementUnitService $measurementUnitService;
    protected IStockService $stockService;

    public function __construct(IInboundService $inboundService, IWarehouseService $warehouseService, ISupplierService $supplierService, IProductService $productService, IMeasurementUnitService $measurementUnitService, IStockService $stockService)
    {
        $this->inboundService = $inboundService;
        $this->warehouseService = $warehouseService;
        $this->supplierService = $supplierService;
        $this->productService = $productService;
        $this->measurementUnitService = $measurementUnitService;
        $this->stockService = $stockService;
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
            ['name' => 'invoice_number', 'type' => 'text', 'label' => 'Invoice Number', 'required' => false],
        ];
        $conditions = $request->only(['supplier_id', 'warehouse_id', 'is_confirmed']);
        $items = $this->inboundService->getAll($conditions, ['*'], ['supplier', 'warehouse', 'inboundItems.product'])->toArray();
        return view('inbounds.index', compact('items', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function show(int $id)
    {
        $inbound = $this->inboundService->getById($id, ['supplier', 'warehouse', 'inboundItems', 'inboundItems.product', 'inboundItems.measurementUnit', 'createdBy'])->toArray();
        return view('inbounds.show', compact('inbound'));
    }

    public function storeItems(Request $request, int $id)
    {
        $data = $request->all();
        $this->inboundService->addInboundItems($id, $data);
        return redirect()->route('inbounds.createInbound', ['id' => $id])->with('success', 'Inbound created successfully.');
    }

    public function createInbound(int $id)
    {
        $usePopup = true;
        $title = 'Inbound Items';
        $action = route('inbounds.storeItems', ['id' => $id]);
        $product = $this->productService->getAllWoP([], ['id', 'name'])->toArray();
        $unit = $this->measurementUnitService->getAllWoP([], ['id', 'abbreviation'])->toArray();
        $products = [];
        $units = [];
        foreach ($product as $item) {
            $products[$item['id']] = $item['name'];
        }
        foreach ($unit as $item) {
            $units[$item['id']] = $item['abbreviation'];
        }
        $inputs = [
            ['name' => 'product_id', 'type' => 'select', 'label' => 'Product', 'required' => true, 'options' => $products],
            ['name' => 'measurement_unit_id', 'type' => 'select', 'label' => 'Unit', 'required' => true, 'options' => $units],
            ['name' => 'quantity', 'type' => 'number', 'label' => 'Quantity', 'required' => true],
            ['name' => 'unit_price', 'type' => 'number', 'label' => 'Unit Price', 'required' => true],
        ];
        $inbound = $this->inboundService->getById($id, ['supplier', 'warehouse', 'inboundItems', 'inboundItems.product', 'inboundItems.measurementUnit'])->toArray();

        return view('inbounds.create', compact('inbound', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $id = $this->inboundService->create($data)->toArray();
        return redirect()->route('inbounds.createInbound', ['id' => $id['id']])->with('success', 'Inbound created successfully.');
    }

    public function destroy(int $id)
    {
        $this->inboundService->delete($id);
        return redirect()->route('inbounds.index')->with('success', 'Inbound deleted successfully.');
    }

    public function deleteItem(int $id)
    {
        $this->inboundService->removeInboundItems($id);
        return redirect()->back()->with('success', 'Inbound item deleted successfully.');
    }

    public function confirm(int $id)
    {
        $inbound = $this->inboundService->getById($id, ['inboundItems'])->toArray();

        // Iterate over inbound items and update the stock
        foreach ($inbound['inbound_items'] as $item) {
            app(IStockService::class)->create([
                'product_id' => $item['product_id'],
                'warehouse_id' => $inbound['warehouse_id'],
                'measurement_unit_id' => $item['measurement_unit_id'],
                'incoming' => $item['quantity'],
                'stock_type' => StockTypeEnum::Inbound->value,
                'reference_type' => 'Inbound',
                'reference_id' => $id,
            ]);
        }

        // Confirm the inbound in the service
        $this->inboundService->confirmInbound($id);

        return redirect()->back()->with('success', 'Inbound confirmed and stock updated successfully.');
    }

}
