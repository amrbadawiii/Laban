@extends('layouts.create')

@section('title', __('quotation.update_quotation'))

@section('subContent')
    <!-- Quotation Details Section -->
    <div class="mb-6 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-4">{{ __('messages.quotation_details') }}</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <x-key-value label="{{ __('quotation.quotation_number') }}" :value="$quotation['quotation_number']" />
            <x-key-value label="{{ __('quotation.quotation_date') }}" :value="$quotation['quotation_date']" />
            <x-key-value label="{{ __('quotation.customer') }}" :value="$quotation['customer']['first_name']" />
            <x-key-value label="{{ __('quotation.warehouse') }}" :value="$quotation['warehouse']['name']" />
            <x-key-value label="{{ __('quotation.quotation_status') }}" :value="$quotation['quotation_status']" />
            <x-key-value label="{{ __('quotation.total_amount') }}" :value="$quotation['total_amount']" />
            <x-key-value label="{{ __('quotation.expiry_date') }}" :value="$quotation['expiry_date']" />
        </div>
    </div>

    @php
        // Define the columns with their type (text, image, link, or actions)
        $columns = [
            ['key' => 'id', 'type' => 'text'],
            ['key' => 'product.name', 'type' => 'text'],
            ['key' => 'measurement_unit.abbreviation', 'type' => 'text'],
            ['key' => 'quantity', 'type' => 'text'],
            ['key' => 'unit_price', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => '#',
                'delete_route' => $quotation['quotation_status'] == 'draft' ? 'quotations.deleteItem' : '#',
            ],
        ];
    @endphp
    <h3 class="text-lg font-bold mb-4">{{ __('quotation.quotation_items') }}</h3>
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm">
        <thead>
            <tr>
                <x-table-header>{{ __('quotation.id') }}</x-table-header>
                <x-table-header>{{ __('quotation.name') }}</x-table-header>
                <x-table-header>{{ __('quotation.measurement_unit') }}</x-table-header>
                <x-table-header>{{ __('quotation.quantity') }}</x-table-header>
                <x-table-header>{{ __('quotation.unit_price') }}</x-table-header>
                <x-table-header>{{ __('messages.actions') }}</x-table-header>
            </tr>
        </thead>
        <tbody>
            @if (!empty($quotation['quotation_items']))
                @foreach ($quotation['quotation_items'] as $quotationItem)
                    <x-table-row :data="$quotationItem" :columns="$columns" route="#" />
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if ($quotation['quotation_status'] == 'draft')
        <!-- Add Item Button -->
        <div class="mt-4">
            <x-popup-form x-show="openPopup" @click.away="openPopup = false" :title="$title" :action="$action"
                :inputs="$inputs" />
        </div>
    @endif

    </div>
@endsection
