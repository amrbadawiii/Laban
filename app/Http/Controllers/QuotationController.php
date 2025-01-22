<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\ICustomerService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\IQuotationService;
use App\Application\Interfaces\IWarehouseService;
use App\Domain\Enums\QuotationStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuotationController extends Controller
{
    protected IQuotationService $quotationService;
    protected IWarehouseService $warehouseService;
    protected ICustomerService $customerService;
    protected IProductService $productService;
    protected IMeasurementUnitService $measurementUnitService;

    public function __construct(IQuotationService $quotationService, IWarehouseService $warehouseService, ICustomerService $customerService, IProductService $productService, IMeasurementUnitService $measurementUnitService)
    {
        $this->quotationService = $quotationService;
        $this->warehouseService = $warehouseService;
        $this->customerService = $customerService;
        $this->productService = $productService;
        $this->measurementUnitService = $measurementUnitService;
    }

    public function index(Request $request)
    {
        $usePopup = true;
        $title = 'Quotation';
        $action = route('quotations.store');
        $warehouse = $this->warehouseService->getAllWoP([], ['id', 'name'])->toArray();
        $customer = $this->customerService->getAllWoP([], ['id', 'first_name'])->toArray();
        $warehouses = [];
        $customers = [];
        foreach ($warehouse as $item) {
            $warehouses[$item['id']] = $item['name'];
        }
        foreach ($customer as $item) {
            $customers[$item['id']] = $item['first_name'];
        }
        $inputs = [
            ['name' => 'warehouse_id', 'type' => 'select', 'label' => 'Warehouse', 'required' => true, 'options' => $warehouses],
            ['name' => 'customer_id', 'type' => 'select', 'label' => 'Customer', 'required' => true, 'options' => $customers],
            ['name' => 'quotation_number', 'type' => 'text', 'label' => 'Quotation Number', 'required' => true],
            ['name' => 'quotation_date', 'type' => 'date', 'label' => 'Quotation Date', 'required' => true],
            ['name' => 'expiry_date', 'type' => 'date', 'label' => 'Expiry Date', 'required' => false],
            ['name' => 'notes', 'type' => 'textarea', 'label' => 'Notes', 'required' => false],
        ];

        $conditions = $request->only(['customer_id', 'warehouse_id', 'quotation_status']);
        $items = $this->quotationService->getAll($conditions, ['*'], ['customer', 'warehouse', 'quotationItems.product'])->toArray();
        return view('quotations.index', compact('items', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function show(int $id)
    {
        $quotation = $this->quotationService->getById($id, ['customer', 'warehouse', 'quotationItems', 'quotationItems.product', 'quotationItems.measurementUnit', 'createdBy'])->toArray();
        return view('quotations.show', compact('quotation'));
    }

    public function createQuotation(int $id)
    {
        $usePopup = true;
        $title = 'Quotation Items';
        $action = route('quotations.storeItems', ['id' => $id]);
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
        $quotation = $this->quotationService->getById($id, ['customer', 'warehouse', 'quotationItems', 'quotationItems.product', 'quotationItems.measurementUnit'])->toArray();

        return view('quotations.create', compact('quotation', 'inputs', 'usePopup', 'title', 'action'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $id = $this->quotationService->create($data);
        return redirect()->route('quotations.createQuotation', ['id' => $id['id']])->with('success', 'Quotation created successfully.');
    }

    public function storeItems(Request $request, int $id)
    {
        $data = $request->all();
        $this->quotationService->addQuotationItems($id, $data);
        return redirect()->route('quotations.createQuotation', ['id' => $id])->with('success', 'Quotation created successfully.');
    }

    public function destroy(int $id)
    {
        $this->quotationService->delete($id);
        return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');
    }
    public function deleteItem(int $id)
    {
        $this->quotationService->removeQuotationItems($id);
        return redirect()->back()->with('success', 'Quotation item deleted successfully.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'quotation_status' => ['required', Rule::in(QuotationStatusEnum::cases())],
        ]);

        $quotation = $this->quotationService->updateStatus($id, $validated['quotation_status']);

        return redirect()->route('quotations.show', $id)->with('status', __('messages.quotation_status_updated'));
    }
}
