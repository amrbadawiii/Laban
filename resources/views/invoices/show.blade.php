@extends('layouts.create')

@section('title', __('messages.show_invoice'))

@section('subContent')

    <!-- Inbound Details Section -->
    <div class="mb-6 bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold mb-4">{{ __('messages.invoice_details') }}</h3>

            @if ($invoice['invoice_status'] == 'unpaid')
                <form action="{{ route('invoices.updateStatus', $invoice['id']) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <select name="invoice_status" onchange="this.form.submit()"
                        class="bg-gray-100 text-gray-700 px-6 py-3 rounded">
                        @foreach (\App\Domain\Enums\InvoiceStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}" @if ($invoice['invoice_status'] == $status->value) selected @endif>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            @endif

        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <x-key-value label="{{ __('invoice.invoice_number') }}" :value="$invoice['invoice_number']" />
            <x-key-value label="{{ __('invoice.invoice_date') }}" :value="$invoice['invoice_date']" />
            <x-key-value label="{{ __('invoice.customer') }}" :value="$invoice['customer']['first_name']" />
            <x-key-value label="{{ __('invoice.warehouse') }}" :value="$invoice['warehouse']['name']" />
            <x-key-value label="{{ __('invoice.invoice_status') }}" :value="$invoice['invoice_status']" />
            <x-key-value label="{{ __('invoice.total_amount') }}" :value="$invoice['total_amount']" />
            <x-key-value label="{{ __('invoice.total_price') }}" :value="$invoice['total_price']" />
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
    ['key' => 'total_price', 'type' => 'text']
];
    @endphp
    <h3 class="text-lg font-bold mb-4">{{ __('messages.inbound_items') }}</h3>
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm">
        <thead>
            <tr>
                <x-table-header>{{ __('invoice.id') }}</x-table-header>
                <x-table-header>{{ __('invoice.name') }}</x-table-header>
                <x-table-header>{{ __('invoice.measurement_unit') }}</x-table-header>
                <x-table-header>{{ __('invoice.quantity') }}</x-table-header>
                <x-table-header>{{ __('invoice.unit_price') }}</x-table-header>
                <x-table-header>{{ __('invoice.total_price') }}</x-table-header>
            </tr>
        </thead>
        <tbody>
            @if (!empty($invoice['invoice_items']))
                @foreach ($invoice['invoice_items'] as $invoice)
                    <x-table-row :data="$invoice" :columns="$columns" route="#" />
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
