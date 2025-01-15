@extends('layouts.index')

@section('title', __('messages.stocks'))
@section('popup_action', route('stocks.store'))
@section('header_link', route('stocks.create'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'product.name', 'type' => 'text'], // Nested property for product name
            ['key' => 'warehouse.name', 'type' => 'text'], // Nested property for warehouse name
            ['key' => 'measurement_unit.name', 'type' => 'text'], // Nested property for measurement unit
            ['key' => 'incoming', 'type' => 'number'], // Incoming stock
            ['key' => 'outgoing', 'type' => 'number'], // Outgoing stock
            ['key' => 'total_stock', 'type' => 'number'], // Calculated total stock
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'stocks.edit', // Route for edit action
                'delete_route' => 'stocks.destroy', // Route for delete action
            ],
        ];
    @endphp
    <thead>
        <tr>
            <x-table-header>{{ __('stocks.product') }}</x-table-header>
            <x-table-header>{{ __('stocks.warehouse') }}</x-table-header>
            <x-table-header>{{ __('stocks.measurement_unit') }}</x-table-header>
            <x-table-header>{{ __('stocks.incoming') }}</x-table-header>
            <x-table-header>{{ __('stocks.outgoing') }}</x-table-header>
            <x-table-header>{{ __('stocks.total_stock') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
            @foreach ($items['data'] as $stock)
                <x-table-row :data="$stock" :columns="$columns" route="stocks.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>
@endsection
