<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IProductService;
use App\Domain\Enums\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $items = $this->productService->getAll()->toArray();
        return view('products.index', compact('items')); // Pass product as an array to the view
    }

    public function show($id)
    {
        $product = $this->productService->getById($id)->toArray();
        return view('products.show', ['product' => $product]); // Pass product as an array to the view
    }

    public function create()
    {
        return view('products.create'); // Show a form for creating a product
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'is_production' => 'nullable|boolean', // You can validate as boolean
            'is_selling' => 'nullable|boolean', // You can validate as boolean
        ]);
        $validated['is_production'] = $validated['is_production'] ?? 0;
        $validated['is_selling'] = $validated['is_selling'] ?? 0;
        $this->productService->create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = $this->productService->getById($id)->toArray();
        return view('products.edit', ['product' => $product]); // Pass warehouse as an array to the view
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'is_production' => 'nullable|boolean', // You can validate as boolean
            'is_selling' => 'nullable|boolean', // You can validate as boolean
        ]);
        $validated['is_production'] = $validated['is_production'] ?? 0;
        $validated['is_selling'] = $validated['is_selling'] ?? 0;

        $this->productService->update($id, $validated);
        return redirect()->route('products.index')->with('success', 'product updated successfully.');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index')->with('success', 'product deleted successfully.');
    }
}
