@extends('layouts.create')

@section('title', __('messages.create_order'))

@section('subContent')
    <!-- Order Details Section -->
    <div class="mb-6 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-bold mb-4">{{ __('messages.order_details') }}</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <x-key-value label="{{ __('order.order_number') }}" :value="$order['order_number']" />
            <x-key-value label="{{ __('order.order_date') }}" :value="$order['order_date']" />
            <x-key-value label="{{ __('order.delivery_date') }}" :value="$order['delivery_date']" />
            <x-key-value label="{{ __('order.customer') }}" :value="$order['customer']['first_name']" />
            <x-key-value label="{{ __('order.warehouse') }}" :value="$order['warehouse']['name']" />
            <x-key-value label="{{ __('order.order_status') }}" :value="$order['order_status']" />
            <x-key-value label="{{ __('order.total_amount') }}" :value="$order['total_amount']" />
        </div>
    </div>

    @php
        // Define the columns with their type (text, image, link, or actions)
        $columns = [
            ['key' => 'id', 'type' => 'text'],
            ['key' => 'product.name', 'type' => 'text'],
            ['key' => 'measurement_unit.abbreviation', 'type' => 'text'],
            ['key' => 'quantity', 'type' => 'text'],
            ['key' => 'unit_price', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => '#',
                'delete_route' => $order['order_status'] == 'pending' ? 'orders.deleteItem' : '#',
            ],
        ];
    @endphp
    <h3 class="text-lg font-bold mb-4">{{ __('messages.order_items') }}</h3>
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm">
        <thead>
            <tr>
                <x-table-header>{{ __('order_item.id') }}</x-table-header>
                <x-table-header>{{ __('order_item.name') }}</x-table-header>
                <x-table-header>{{ __('order_item.measurement_unit') }}</x-table-header>
                <x-table-header>{{ __('order_item.quantity') }}</x-table-header>
                <x-table-header>{{ __('order_item.unit_price') }}</x-table-header>
                <x-table-header>{{ __('messages.actions') }}</x-table-header>
            </tr>
        </thead>
        <tbody>
            @if (!empty($order['order_items']))
                @foreach ($order['order_items'] as $orderItem)
                    <x-table-row :data="$orderItem" :columns="$columns" route="#" />
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
                </tr>
            @endif
        </tbody>
    </table>
    @if ($order['order_status'] == 'pending')
        <!-- Add Item Button -->
        <div class="mt-4">
            <x-popup-form x-show="openPopup" @click.away="openPopup = false" :title="$title" :action="$action"
                :inputs="$inputs" />
        </div>
    @endif

    </div>
@endsection
