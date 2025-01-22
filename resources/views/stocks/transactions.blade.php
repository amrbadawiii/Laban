@extends('layouts.index')

@section('title', __('stock.transactionsForProductID') . $productId .", ". __('stock.inWarehouseID') . $warehouseId)

@section('header_link', '#')

@section('subContent')
    <thead>
        <tr class="bg-gray-200">
            <x-table-header>{{ __('stock.transactionID') }}</x-table-header>
            <x-table-header>{{ __('stock.stockType') }}</x-table-header>
            <x-table-header>{{ __('stock.incoming') }}</x-table-header>
            <x-table-header>{{ __('stock.outgoing') }}</x-table-header>
            <x-table-header>{{ __('stock.reference') }}</x-table-header>
            <x-table-header>{{ __('stock.date') }}</x-table-header>
        </tr>
    </thead>
    <tbody>

        @foreach ($transactions as $transaction)
            <x-table-row :data="[
                'id' => $transaction['id'],
                'stock_type' => $transaction['stock_type'],
                'incoming' => $transaction['incoming'],
                'outgoing' => $transaction['outgoing'],
                'reference_type' => $transaction['reference_type'],
                'date' => $transaction['created_at'],
            ]" :columns="[
                ['key' => 'id', 'type' => 'default'],
                ['key' => 'stock_type', 'type' => 'default'],
                ['key' => 'incoming', 'type' => 'default'],
                ['key' => 'outgoing', 'type' => 'default'],
                ['key' => 'reference_type', 'type' => 'default'],
                ['key' => 'date', 'type' => 'default'],
            ]" :route="'#'" />
        @endforeach
    </tbody>
@endsection
