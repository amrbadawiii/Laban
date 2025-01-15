@extends('layouts.index')

@section('title', __('Stock Overview for Product ID: ') . $productId)

@section('header_link', '#')

@section('subContent')
    <thead>
        <tr class="bg-gray-200">
            <x-table-header>{{ __('Warehouse ID') }}</x-table-header>
            <x-table-header>{{ __('Warehouse Name') }}</x-table-header>
            <x-table-header>{{ __('Incoming') }}</x-table-header>
            <x-table-header>{{ __('Outgoing') }}</x-table-header>
            <x-table-header>{{ __('Total Stock') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($warehouses as $warehouse)
            <x-table-row :data="[
                'warehouse_id' => $warehouse['warehouse_id'],
                'warehouse_name' => $warehouse['warehouse_name'],
                'incoming' => $warehouse['incoming'],
                'outgoing' => $warehouse['outgoing'],
                'total_stock' => $warehouse['total_stock'],
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
