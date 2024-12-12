<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IStockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private IStockService $stockService;

    public function __construct(IStockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index()
    {
        $items = $this->stockService->getAllStocks();
        return view('stocks.index', compact('items'));
    }

    public function show(int $productId)
    {
        $stock = $this->stockService->getStockByProduct($productId);
        $currentStock = $this->stockService->calculateStock($productId);

        return view('stocks.show', compact('stock', 'currentStock'));
    }

    public function addDebit(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'debit' => 'required|numeric|min:0.01',
            'warehouse_id' => 'required|exists:warehouses,id',
            'measurement_unit_id' => 'required|exists:measurement_units,id',
        ]);

        $this->stockService->addDebit($validated);

        return redirect()->route('stocks.index')->with('success', __('messages.debit_added'));
    }
}
