@extends('layouts.index')

@section('title', __('messages.invoice'))
@section('header_link', route('invoices.create'))

@section('subContent')

    @php
        // Define the columns with their type (text, image, link, or toggle)
        $columns = [
            ['key' => 'invoice_number', 'type' => 'text'],
            ['key' => 'order_id', 'type' => 'text'],
            ['key' => 'invoice_date', 'type' => 'date'],
            ['key' => 'customer.first_name', 'type' => 'text'],
            ['key' => 'total_price', 'type' => 'number'],
            ['key' => 'invoice_status', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'invoices.edit',
                'delete_route' => 'invoices.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('invoice.invoiceNumber') }}</x-table-header>
            <x-table-header>{{ __('invoice.orderId') }}</x-table-header>
            <x-table-header>{{ __('invoice.invoiceDate') }}</x-table-header>
            <x-table-header>{{ __('invoice.customerName') }}</x-table-header>
            <x-table-header>{{ __('invoice.totalPrice') }}</x-table-header>
            <x-table-header>{{ __('invoice.invoiceStatus') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
            @foreach ($items['data'] as $invoice)
                <x-table-row :data="$invoice" :columns="$columns" route="invoices.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>

@endsection
