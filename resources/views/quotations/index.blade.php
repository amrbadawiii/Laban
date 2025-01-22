@extends('layouts.index')

@section('title', __('messages.quotations'))
@section('popup_action', route('quotations.store')) {{-- Used for popup form --}}
@section('header_link', route('quotations.create')) {{-- Used if popup is disabled --}}

@section('subContent')

    @php
        $columns = [
            ['key' => 'quotation_number', 'type' => 'text'], // Nested property for product name
            ['key' => 'quotation_date', 'type' => 'date'], // Nested property for supplier name
            ['key' => 'customer.first_name', 'type' => 'text'], // Date formatting
            ['key' => 'warehouse.name', 'type' => 'text'], // Text formatting
            ['key' => 'quotation_status', 'type' => 'text'], // Text formatting
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'quotations.createQuotation', // Route for edit action
                'delete_route' => 'quotations.destroy', // Route for delete action
            ],
        ];
    @endphp
    <thead>
        <tr>
            <x-table-header>{{ __('quotation.quotation_number') }}</x-table-header>
            <x-table-header>{{ __('quotation.quotation_date') }}</x-table-header>
            <x-table-header>{{ __('quotation.customer') }}</x-table-header>
            <x-table-header>{{ __('quotation.warehouse') }}</x-table-header>
            <x-table-header>{{ __('quotation.quotation_status') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @if (!empty($items['data']))
            @foreach ($items['data'] as $quotation)
                <x-table-row :data="$quotation" :columns="$columns" route="quotations.show" />
            @endforeach
        @else
            <tr>
                <td colspan="{{ count($columns) }}" class="text-center">No data available</td>
            </tr>
        @endif
    </tbody>
@endsection
