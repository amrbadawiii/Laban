@extends('layouts.create')

@section('title', 'Product Details')

@section('subContent')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Name:</h3>
        <p class="mt-2 text-gray-500">{{ $product->name }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Code:</h3>
        <p class="mt-2 text-gray-500">{{ $product->code }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Barcode:</h3>
        <p class="mt-2 text-gray-500"><img src="{{ asset($product->barcode) }}" alt="barcode" /></p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Measurement Code:</h3>
        <p class="mt-2 text-gray-500">{{ $product->measurement_code->code }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Type:</h3>
        <p class="mt-2 text-gray-500">{{ $product->type }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Category:</h3>
        <p class="mt-2 text-gray-500">{{ $product->category->name_en }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Supplier:</h3>
        <p class="mt-2 text-gray-500">{{ $product->supplier->name }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Colour:</h3>
        <p class="mt-2 text-gray-500">{{ $product->colour }}</p>
    </div>

</div>

<div class="mt-6">
    <a href="{{ route('products.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-300">
        Back to Products
    </a>
</div>
@endsection