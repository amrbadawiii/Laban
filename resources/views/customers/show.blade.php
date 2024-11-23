@extends('layouts.create')

@section('title', 'Customer Details')

@section('subContent')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Name:</h3>
        <p class="mt-2 text-gray-500">{{ $customer->name }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Address:</h3>
        <p class="mt-2 text-gray-500">{{ $customer->address }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Mobile Number:</h3>
        <p class="mt-2 text-gray-500">{{ $customer->mobile_number }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Code:</h3>
        <p class="mt-2 text-gray-500">{{ $customer->code }}</p>
    </div>
</div>

<div class="mt-6">
    <a href="{{ route('customers.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-300">
        Back to Customers
    </a>
</div>
@endsection