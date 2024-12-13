@extends('layouts.create')

@section('title', __('messages.edit'))

@section('subContent')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-lg font-medium text-gray-700">{{ __('messages.edit_details') }}</h3>

            <form action="{{ route('inbounds.update', $inbound['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Product Selection -->
                <x-select name="product_id" label="{{ __('messages.product') }}" :options="$products['data']" :selected="$inbound['product_id']"
                    required />

                <!-- Measurement Unit Selection -->
                <x-select name="measurement_unit_id" label="{{ __('messages.measurement_unit') }}" :options="$measurementUnits['data']"
                    :selected="$inbound['measurement_unit_id']" required />

                <!-- Quantity Input -->
                <x-text-input name="quantity" type="number" step="0.01" label="{{ __('messages.quantity') }}"
                    :value="$inbound['quantity']" required />

                <!-- Supplier Selection -->
                <x-select name="supplier_id" label="{{ __('messages.supplier') }}" :options="$suppliers['data']" :selected="$inbound['supplier_id']"
                    nullable />

                <!-- Warehouse Selection -->
                <x-select name="warehouse_id" label="{{ __('messages.warehouse') }}" :options="$warehouses['data']" :selected="$inbound['warehouse_id']"
                    required />

                <!-- Received Date Input -->
                <x-text-input name="received_date" type="date" label="{{ __('messages.received_date') }}"
                    :value="$inbound['received_date']" required />

                <!-- Invoice Number Input -->
                <x-text-input name="invoice_number" label="{{ __('messages.invoice_number') }}" :value="$inbound['invoice_number']" />

                <!-- Is Confirmed Checkbox -->
                <x-checkbox name="is_confirmed" label="{{ __('messages.is_confirmed') }}" :checked="$inbound['is_confirmed']" />

                <!-- Submit and Cancel Buttons -->
                <div class="mt-6 flex justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
                        {{ __('messages.update') }}
                    </button>
                    <a href="{{ route('inbounds.index') }}"
                        class="bg-gray-500 text-white px-6 py-3 rounded-lg shadow hover:bg-gray-600">
                        {{ __('messages.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
