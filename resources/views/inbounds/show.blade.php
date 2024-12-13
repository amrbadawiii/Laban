@extends('layouts.create')

@section('title', __('messages.details'))

@section('subContent')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-4 shadow rounded-lg">
            <h3 class="text-lg font-medium text-gray-700">{{ __('messages.details') }}</h3>

            <x-key-value label="{{ __('product.name') }}" :value="$inbound['product']['name']" />
            <x-key-value label="{{ __('quantity') }}" :value="$inbound['quantity']" :valueTwo="$inbound['measurement_unit']['abbreviation']" />
            <x-key-value label="{{ __('supplier.name') }}" :value="$inbound['supplier']['name'] ?? __('messages.not_available')" />
            <x-key-value label="{{ __('warehouse.name') }}" :value="$inbound['warehouse']['name']" />
            <x-key-value label="{{ __('receivedDate') }}" :value="$inbound['received_date']" />
            <x-key-value label="{{ __('isConfirmed') }}" :value="$inbound['is_confirmed'] ? __('Yes') : __('No')" />
        </div>
    </div>

    @if (!$inbound['is_confirmed'])
        <form action="{{ route('inbounds.confirm', $inbound['id']) }}" method="POST">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow hover:bg-green-600">
                {{ __('messages.confirm') }}
            </button>
        </form>
    @endif

    <div class="mt-6">
        <a href="{{ route('inbounds.index') }}"
            class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600">
            {{ __('messages.back') }}
        </a>
    </div>
@endsection
