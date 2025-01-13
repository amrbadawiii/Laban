@extends('layouts.index')

@section('title', __('messages.order'))
@section('popup_action', route('orders.store')) {{-- Used for popup form --}}
@section('header_link', route('orders.create')) {{-- Used if popup is disabled --}}

@section('subContent')

    @php
        // Define the columns with their type (text, image, link, or toggle)
        $columns = [
            ['key' => 'orderNumber', 'type' => 'text'],
            ['key' => 'orderDate', 'type' => 'date'],
            ['key' => 'customer.name', 'type' => 'text'],
            ['key' => 'totalAmount', 'type' => 'number'],
            ['key' => 'orderStatus', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'orders.edit',
                'delete_route' => 'orders.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('order.orderNumber') }}</x-table-header>
            <x-table-header>{{ __('order.orderDate') }}</x-table-header>
            <x-table-header>{{ __('order.customerName') }}</x-table-header>
            <x-table-header>{{ __('order.totalAmount') }}</x-table-header>
            <x-table-header>{{ __('order.orderStatus') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
            @foreach ($items['data'] as $order)
                <x-table-row :data="$order" :columns="$columns" route="orders.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>

@endsection
