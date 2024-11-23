@extends('layouts.create')

@section('title', 'Create Invoice')

@section('subContent')

<form action="{{ route('invoices.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-medium text-gray-700">Choose Customer</label>
            <select name="customer_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">New Customer</option>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Customer Name</label>
            <input type="text" name="customer_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Customer Address</label>
            <input type="text" name="customer_address" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Customer Mobile</label>
            <input type="text" name="customer_mobile" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Products</label>
            @foreach($products as $product)
            <div class="flex items-center mb-2">
                <input type="checkbox" name="products[{{ $product->id }}][product_id]" value="{{ $product->id }}" class="mr-2">
                <label>{{ $product->name }}</label>
                <input type="number" name="products[{{ $product->id }}][quantity]" class="ml-2 p-2 border rounded w-20" placeholder="Qty">
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Create
        </button>
    </div>
</form>
@endsection