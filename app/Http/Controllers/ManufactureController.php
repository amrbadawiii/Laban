<?php

namespace App\Http\Controllers;

use App\Application\Interfaces\IProductService;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{

    private IProductService $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('manufacture.index'); // Pass customers as an array to the view
    }

    public function show($id)
    {
        return view('manufacture.show'); // Pass customer as an array to the view
    }

    public function stage($id)
    {
        switch ($id) {
            case 0:

                break;
            case 1:

                break;
            case 2:

                break;
            case 3:

                break;
            case 4:

                break;
            case 5:

                break;
            default:
                return view('manufacture.stage1');
        }
        return view('manufacture.create'); // Show a form for creating a warehouse
    }

    public function store(Request $request)
    {
        return redirect()->route('manufacture.index')->with('success', 'customer created successfully.');
    }

    public function edit($id)
    {
        return view('manufacture.edit'); // Pass customer as an array to the view
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('manufacture.index')->with('success', 'customer updated successfully.');
    }

    public function destroy($id)
    {
        return redirect()->route('manufacture.index')->with('success', 'customer deleted successfully.');
    }
}
