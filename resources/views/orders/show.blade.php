@extends('layouts.create')

@section('title', __('messages.show_order'))

@section('subContent')

    <!-- Inbound Details Section -->
    <div class="mb-6 bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold mb-4">{{ __('messages.order_details') }}</h3>

            @if ($order['order_status'] == 'pending' || $order['order_status'] == 'processing')
                <form action="{{ route('orders.updateStatus', $order['id']) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <select name="order_status" onchange="this.form.submit()"
                        class="bg-gray-100 text-gray-700 px-6 py-3 rounded">
                        @foreach (\App\Domain\Enums\OrderStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}" @if ($order['order_status'] == $status->value) selected @endif>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            @endif

        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <x-key-value label="{{ __('order.order_number') }}" :value="$order['order_number']" />
            <x-key-value label="{{ __('order.order_date') }}" :value="$order['order_date']" />
            <x-key-value label="{{ __('order.delivery_date') }}" :value="$order['delivery_date']" />
            <x-key-value label="{{ __('order.customer') }}" :value="$order['customer']['first_name']" />
            <x-key-value label="{{ __('order.warehouse') }}" :value="$order['warehouse']['name']" />
            <x-key-value label="{{ __('order.order_status') }}" :value="$order['order_status']" />
            <x-key-value label="{{ __('order.total_amount') }}" :value="$order['total_amount']" />
            <x-key-value label="{{ __('messages.user') }}" :value="$order['created_by']['name']" />
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
    ['key' => 'total_price', 'type' => 'text'],
];
    @endphp
    <h3 class="text-lg font-bold mb-4">{{ __('order.order_items') }}</h3>
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm">
        <thead>
            <tr>
                <x-table-header>{{ __('order.id') }}</x-table-header>
                <x-table-header>{{ __('order.name') }}</x-table-header>
                <x-table-header>{{ __('order.measurement_unit') }}</x-table-header>
                <x-table-header>{{ __('order.quantity') }}</x-table-header>
                <x-table-header>{{ __('order.unit_price') }}</x-table-header>
                <x-table-header>{{ __('order.total_price') }}</x-table-header>
            </tr>
        </thead>
        <tbody>
            @if (!empty($order['order_items']))
                @foreach ($order['order_items'] as $order)
                    <x-table-row :data="$order" :columns="$columns" route="#" />
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($columns) }}" class="text-center">{{ __('messages.no_data_available') }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    </div>
@endsection
