@extends('layouts.index')

@section('title', __('messages.total_stock'))
@section('header_link', route('stocks.index'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'product.name', 'type' => 'text'], // Product name
            ['key' => 'total_stock', 'type' => 'number'], // Total stock
        ];
    @endphp
    <thead>
        <tr>
            <x-table-header>{{ __('stocks.product') }}</x-table-header>
            <x-table-header>{{ __('stocks.total_stock') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($totalStock as $stock)
            <x-table-row :data="$stock" :columns="$columns" />
        @endforeach
    </tbody>
@endsection
