@extends('layouts.index')

@section('title', __('messages.inbound'))
@section('popup_action', route('inbounds.store')) {{-- Used for popup form --}}
@section('header_link', route('inbounds.create')) {{-- Used if popup is disabled --}}

@section('subContent')


    <thead>
        <tr>
            <x-table-header>{{ __('inbound.reference_number') }}</x-table-header>
            <x-table-header>{{ __('inbound.supplier') }}</x-table-header>
            <x-table-header>{{ __('inbound.warehouse') }}</x-table-header>
            <x-table-header>{{ __('inbound.received_date') }}</x-table-header>
            <x-table-header>{{ __('inbound.invoice_number') }}</x-table-header>
            <x-table-header>{{ __('inbound.is_confirmed') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
                    @foreach ($items['data'] as $inbound)
                                @php
                                    $columns = [
                                        ['key' => 'reference_number', 'type' => 'text'], // Nested property for product name
                                        ['key' => 'supplier.name', 'type' => 'text'], // Nested property for supplier name
                                        ['key' => 'warehouse.name', 'type' => 'text'], // Nested property for warehouse name
                                        ['key' => 'received_date', 'type' => 'date'], // Date formatting
                                        ['key' => 'invoice_number', 'type' => 'text'], // Text formatting
                                        ['key' => 'is_confirmed', 'type' => 'boolean'], // Boolean formatting
                                        [
                                            'key' => 'actions',
                                            'type' => 'actions',
                                            'route' => $inbound['is_confirmed'] == 1 ? '#' : 'inbounds.createInbound', // Route for edit action
                                            'delete_route' => $inbound['is_confirmed'] == 1 ? '#' : 'inbounds.destroy', // Route for delete action
                                        ],
                                    ];
                                @endphp
                                    <x-table-row :data="$inbound" :columns="$columns" route="inbounds.show" />
                    @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>
@endsection
