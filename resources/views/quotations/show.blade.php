@extends('layouts.create')

@section('title', __('messages.show_quotation'))

@section('subContent')

    <!-- quotation Details Section -->
    <div class="mb-6 bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold mb-4">{{ __('messages.quotation_details') }}</h3>

            @if ($quotation['quotation_status'] == 'draft' || $quotation['quotation_status'] == 'sent')
                <form action="{{ route('quotations.updateStatus', $quotation['id']) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <select name="quotation_status" onchange="this.form.submit()"
                        class="bg-gray-100 text-gray-700 px-6 py-3 rounded">
                        @foreach (\App\Domain\Enums\QuotationStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}" @if ($quotation['quotation_status'] == $status->value) selected @endif>
                                {{ ucfirst($status->value) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            @endif

        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <x-key-value label="{{ __('quotation.quotation_number') }}" :value="$quotation['quotation_number']" />
            <x-key-value label="{{ __('quotation.quotation_date') }}" :value="$quotation['quotation_date']" />
            <x-key-value label="{{ __('quotation.customer') }}" :value="$quotation['customer']['first_name']" />
            <x-key-value label="{{ __('quotation.warehouse') }}" :value="$quotation['warehouse']['name']" />
            <x-key-value label="{{ __('quotation.quotation_status') }}" :value="$quotation['quotation_status']" />
            <x-key-value label="{{ __('quotation.total_amount') }}" :value="$quotation['total_amount']" />
            <x-key-value label="{{ __('quotation.expiry_date') }}" :value="$quotation['expiry_date']" />
            <x-key-value label="{{ __('messages.user') }}" :value="$quotation['created_by']['name']" />
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
];
    @endphp
    <h3 class="text-lg font-bold mb-4">{{ __('quotation.quotation_items') }}</h3>
    <table class="min-w-full bg-white dark:bg-gray-800 text-sm">
        <thead>
            <tr>
                <x-table-header>{{ __('quotation.id') }}</x-table-header>
                <x-table-header>{{ __('quotation.name') }}</x-table-header>
                <x-table-header>{{ __('quotation.measurement_unit') }}</x-table-header>
                <x-table-header>{{ __('quotation.quantity') }}</x-table-header>
                <x-table-header>{{ __('quotation.unit_price') }}</x-table-header>
            </tr>
        </thead>
        <tbody>
            @if (!empty($quotation['quotation_items']))
                @foreach ($quotation['quotation_items'] as $quotation)
                    <x-table-row :data="$quotation" :columns="$columns" route="#" />
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
