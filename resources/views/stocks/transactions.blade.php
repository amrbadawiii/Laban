@extends('layouts.index')

@section('title', __('Transactions for Product ID: ') . $productId . __(' in Warehouse ID: ') . $warehouseId)

@section('header_link', '#')

@section('subContent')
    <thead>
        <tr class="bg-gray-200">
            <x-table-header>{{ __('Transaction ID') }}</x-table-header>
            <x-table-header>{{ __('Stock Type') }}</x-table-header>
            <x-table-header>{{ __('Incoming') }}</x-table-header>
            <x-table-header>{{ __('Outgoing') }}</x-table-header>
            <x-table-header>{{ __('Reference') }}</x-table-header>
            <x-table-header>{{ __('Date') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <x-table-row :data="[
                'id' => $transaction['id'],
                'stock_type' => $transaction['stock_type'],
                'incoming' => $transaction['incoming'],
                'outgoing' => $transaction['outgoing'],
                'reference' => $transaction['reference'],
                'date' => $transaction['created_at'],
            ]" :columns="[
                ['key' => 'id', 'type' => 'default'],
                ['key' => 'stock_type', 'type' => 'default'],
                ['key' => 'incoming', 'type' => 'default'],
                ['key' => 'outgoing', 'type' => 'default'],
                ['key' => 'reference', 'type' => 'default'],
                ['key' => 'date', 'type' => 'default'],
            ]" :route="'#'" />
        @endforeach
    </tbody>
@endsection
