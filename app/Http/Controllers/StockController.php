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

    /**
     * Display a listing of products with their total stock.
     */
    public function index()
    {
        // Fetch all products with their total stock
        $products = $this->stockService->getProductsWithTotalStock();
        return view('stocks.index', compact('products'));
    }

    /**
     * Display stock details for a specific product grouped by warehouses.
     *
     * @param int $productId
     */
    public function showProductStock(int $productId)
    {
        // Fetch stock grouped by warehouses for the given product
        $warehouses = $this->stockService->getProductStockGroupedByWarehouse($productId);
        return view('stocks.product', compact('warehouses', 'productId'));
    }

    /**
     * Display stock transactions for a specific product in a specific warehouse.
     *
     * @param int $productId
     * @param int $warehouseId
     */
    public function showWarehouseTransactions(int $productId, int $warehouseId)
    {
        // Fetch transactions for the given product and warehouse
        $transactions = $this->stockService->getTransactions($productId, $warehouseId);
        return view('stocks.transactions', compact('transactions', 'productId', 'warehouseId'));
    }

    /**
     * Search for stock records.
     *
     * @param Request $request
     */
    public function search(Request $request)
    {
        $criteria = $request->only(['product_id', 'warehouse_id', 'stock_type']);
        $results = $this->stockService->search($criteria);

        return response()->json($results);
    }
}
