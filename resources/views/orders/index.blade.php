@extends('layouts.index')

@section('title', __('messages.order'))
@section('popup_action', route('orders.store')) {{-- Used for popup form --}}
@section('header_link', route('orders.create')) {{-- Used if popup is disabled --}}

@section('subContent')

    <thead>
        <tr>
            <x-table-header>{{ __('order.order_number') }}</x-table-header>
            <x-table-header>{{ __('order.order_date') }}</x-table-header>
            <x-table-header>{{ __('order.delivery_date') }}</x-table-header>
            <x-table-header>{{ __('order.customer') }}</x-table-header>
            <x-table-header>{{ __('order.warehouse') }}</x-table-header>
            <x-table-header>{{ __('order.order_status') }}</x-table-header>
            <x-table-header>{{ __('order.total_amount') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
            @foreach ($items['data'] as $order)
                @php
                    $columns = [
                        ['key' => 'order_number', 'type' => 'text'], // Nested property for product name
                        ['key' => 'order_date', 'type' => 'date'], // Nested property for supplier name
                        ['key' => 'delivery_date', 'type' => 'date'], // Nested property for warehouse name
                        ['key' => 'customer.first_name', 'type' => 'text'], // Date formatting
                        ['key' => 'warehouse.name', 'type' => 'text'], // Text formatting
                        ['key' => 'order_status', 'type' => 'text'], // Text formatting
                        ['key' => 'total_amount', 'type' => 'text'], // Text formatting
                        [
                            'key' => 'actions',
                            'type' => 'actions',
                            'route' => ($order['order_status'] == 'completed' || $order['order_status'] == 'cancelled') && Session::get('role') !== 'admin'? '#' : 'orders.createOrder', // Route for edit action
                            'delete_route' => ($order['order_status'] == 'completed' || $order['order_status'] == 'cancelled') && Session::get('role') !== 'admin' ? '#' : 'orders.destroy', // Route for delete action
                        ],
                    ];
                @endphp
                    <x-table-row :data="$order" :columns="$columns" route="orders.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>
@endsection
