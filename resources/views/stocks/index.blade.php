@extends('layouts.index')

@section('title', __('Products Stock Overview'))

@section('header_link', '#')

@section('subContent')
    <thead>
        <tr class="bg-gray-200">
            <x-table-header>{{ __('Product ID') }}</x-table-header>
            <x-table-header>{{ __('Product Name') }}</x-table-header>
            <x-table-header>{{ __('Incoming') }}</x-table-header>
            <x-table-header>{{ __('Outgoing') }}</x-table-header>
            <x-table-header>{{ __('Total Stock') }}</x-table-header>
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
