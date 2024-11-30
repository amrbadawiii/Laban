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
        $items = $this->productService->getAllProducts();
        $types = Type::reverse();
        return view('products.index', compact('items', 'types'));
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        $types = Type::reverse();
        return view('products.show', compact('product', 'types'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);

        $this->productService->createProduct($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required',
        ]);

        $this->productService->updateProduct($id, $validated);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
