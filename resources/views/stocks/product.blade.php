@extends('layouts.index')

@section('title', __('stock.stockOverviewforProductID') . $productId)

@section('header_link', '#')

@section('subContent')
    <thead>
        <tr class="bg-gray-200">
            <x-table-header>{{ __('stock.warehouseID') }}</x-table-header>
            <x-table-header>{{ __('stock.warehouseName') }}</x-table-header>
            <x-table-header>{{ __('stock.incoming') }}</x-table-header>
            <x-table-header>{{ __('stock.outgoing') }}</x-table-header>
            <x-table-header>{{ __('stock.totalStock') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($warehouses as $warehouse)
            <x-table-row :data="[
                'warehouse_id' => $warehouse['warehouse_id'],
                'warehouse_name' => $warehouse['warehouse']['name'],
                'incoming' => $warehouse['incoming'],
                'outgoing' => $warehouse['outgoing'],
                'total_stock' => $warehouse['incoming'] - $warehouse['outgoing'],
            ]" :columns="[
                ['key' => 'warehouse_id', 'type' => 'default'],
                ['key' => 'warehouse_name', 'type' => 'default'],
                ['key' => 'incoming', 'type' => 'default'],
                ['key' => 'outgoing', 'type' => 'default'],
                ['key' => 'total_stock', 'type' => 'default'],
            ]" :route="'stocks.transactions'" :routeParams="['productId' => $productId, 'warehouseId' => $warehouse['warehouse_id']]" />
        @endforeach
    </tbody>
@endsection
