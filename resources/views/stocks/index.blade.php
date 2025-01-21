@extends('layouts.index')

@section('title', __('stock.productsStockOverview'))

@section('header_link', '#')

@section('subContent')
    <thead>
        <tr class="bg-gray-200">
            <x-table-header>{{ __('stock.productID') }}</x-table-header>
            <x-table-header>{{ __('stock.productName') }}</x-table-header>
            <x-table-header>{{ __('stock.incoming') }}</x-table-header>
            <x-table-header>{{ __('stock.outgoing') }}</x-table-header>
            <x-table-header>{{ __('stock.totalStock') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <x-table-row :data="[
                'id' => $product->product_id,
                'product' => $product->product->name,
                'incoming' => number_format($product->incoming, 2),
                'outgoing' => number_format($product->outgoing, 2),
                'total_stock' => number_format($product->total_stock, 2),
            ]" :columns="[
                ['key' => 'id', 'type' => 'default'],
                ['key' => 'product', 'type' => 'default'],
                ['key' => 'incoming', 'type' => 'default'],
                ['key' => 'outgoing', 'type' => 'default'],
                ['key' => 'total_stock', 'type' => 'default'],
            ]" :route="'stocks.product'" />
        @endforeach
    </tbody>
@endsection
