@extends('layouts.create')

@section('title', __('messages.create_inbound'))

@section('subContent')
    <form action="{{ route('inbounds.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Product Dropdown -->
            <x-select name="product_id" label="{{ __('inbound.product') }}" :options="$products['data']" :selected="old('product_id')" required />

            <!-- Measurement Unit Dropdown -->
            <x-select name="measurement_unit_id" label="{{ __('inbound.measurementUnit') }}" :options="$measurementUnits['data']"
                :selected="old('measurement_unit_id')" displayKey="abbreviation" required />

            <!-- Quantity -->
            <x-text-input name="quantity" label="{{ __('inbound.quantity') }}" :value="old('quantity')" required type="number" />

            <!-- Supplier Dropdown -->
            <x-select name="supplier_id" label="{{ __('inbound.supplier') }}" :options="$suppliers['data']" :selected="old('supplier_id')" />

            <!-- Warehouse Dropdown -->
            <x-select name="warehouse_id" label="{{ __('inbound.warehouse') }}" :options="$warehouses['data']" :selected="old('warehouse_id')"
                required />

            <!-- Received Date -->
            <x-text-input name="received_date" label="{{ __('inbound.receivedDate') }}" :value="old('received_date')" required
                type="date" />

            <!-- Invoice Number -->
            <x-text-input name="invoice_number" label="{{ __('inbound.invoiceNumber') }}" :value="old('invoice_number')"
                type="text" />
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                {{ __('messages.create') }}
            </button>
        </div>
    </form>
@endsection
