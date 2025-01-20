@extends('layouts.create')

@section('title', __('messages.create_inbound'))

@section('subContent')
    <!-- Inbound Details Section -->
    <div class="mb-6 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-4">{{ __('messages.inbound_details') }}</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <x-key-value label="{{ __('inbound.reference_number') }}" :value="$inbound['reference_number']" />
            <x-key-value label="{{ __('inbound.supplier') }}" :value="$inbound['supplier']['name']" />
            <x-key-value label="{{ __('inbound.warehouse') }}" :value="$inbound['warehouse']['name']" />
            <x-key-value label="{{ __('inbound.received_date') }}" :value="$inbound['received_date']" />
            <x-key-value label="{{ __('inbound.invoice_number') }}" :value="$inbound['invoice_number']" />
            <x-key-value label="{{ __('inbound.is_confirmed') }}" :value="$inbound['is_confirmed']" />
        </div>
    </div>

    @php
        // Define the columns with their type (text, image, link, or actions)
        $columns = [
            ['key' => 'id', 'type' => 'text'],
            ['key' => 'product.name', 'type' => 'text'],
            ['key' => 'measurement_unit.abbreviation', 'type' => 'text'],
            ['key' => 'quantity', 'type' => 'number'],
            ['key' => 'unit_price', 'type' => 'number'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => '#',
                'delete_route' => $inbound['is_confirmed'] == 0 ? 'inbounds.deleteItem' : '#',
            ],
        ];
    @endphp
    <h3 class="text-lg font-bold mb-4">{{ __('messages.inbound_items') }}</h3>
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm">
        <thead>
            <tr>
                <x-table-header>{{ __('inbound_item.id') }}</x-table-header>
                <x-table-header>{{ __('inbound_item.name') }}</x-table-header>
                <x-table-header>{{ __('inbound_item.measurement_unit') }}</x-table-header>
                <x-table-header>{{ __('inbound_item.quantity') }}</x-table-header>
                <x-table-header>{{ __('inbound_item.unit_price') }}</x-table-header>
                <x-table-header>{{ __('messages.actions') }}</x-table-header>
            </tr>
        </thead>
        <tbody>
            @if (!empty($inbound['inbound_items']))
                @foreach ($inbound['inbound_items'] as $inboundItem)
                    <x-table-row :data="$inboundItem" :columns="$columns" route="#" />
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if ($inbound['is_confirmed'] == 0)
        <!-- Add Item Button -->
        <div class="mt-4">
            <x-popup-form x-show="openPopup" @click.away="openPopup = false" :title="$title" :action="$action"
                :inputs="$inputs" />
        </div>
    @endif

    </div>
@endsection
