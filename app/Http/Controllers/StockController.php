<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IStockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected IStockService $stockService;

    public function __construct(IStockService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Display a listing of all stocks without pagination.
     */
    public function indexWoP(Request $request)
    {
        $conditions = $request->input('conditions', []);
        $columns = $request->input('columns', ['*']);
        $relations = $request->input('relations', []);

        $items = $this->stockService->getAllWoP($conditions, $columns, $relations)->toArray();
        return view('stocks.index', compact('items'));
    }

    /**
     * Display a paginated listing of stocks.
     */
    public function index(Request $request)
    {
        $conditions = $request->input('conditions', []);
        $columns = $request->input('columns', ['*']);
        $relations = $request->input('relations', ['product', 'warehouse', 'measurementUnit']);

        $items = $this->stockService->getAll($conditions, $columns, $relations)->toArray();
        return view('stocks.index', compact('items'));
    }

    /**
     * Display the details of a specific stock.
     */
    public function show(int $id, Request $request)
    {
        $relations = $request->input('relations', ['product', 'warehouse', 'measurementUnit']);
        $stock = $this->stockService->getById($id, $relations)->toArray();

        return view('stocks.show', compact('stock'));
    }

    /**
     * Store a new stock in the database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'credit' => 'required|numeric|min:0',
            'debit' => 'required|numeric|min:0',
            'measurement_unit_id' => 'required|integer|exists:measurement_units,id',
        ]);

        $this->stockService->create($data);
        return redirect()->route('stocks.index')->with('success', 'Stock created successfully.');
    }

    /**
     * Delete a stock.
     */
    public function destroy(int $id)
    {
        $this->stockService->delete($id);
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }

    /**
     * Display total stock information.
     */
    public function totalStock(Request $request)
    {
        $warehouseId = $request->input('warehouse_id');
        $totalStock = $this->stockService->getTotalStock($warehouseId);

        return view('stocks.total', compact('totalStock'));
    }
}
