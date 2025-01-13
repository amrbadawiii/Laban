@extends('layouts.index')

@section('title', __('messages.quotation'))

@section('popup_action', route('quotations.store')) {{-- Used for popup form --}}
@section('header_link', route('quotations.create')) {{-- Used if popup is disabled --}}

@section('subContent')
    @php
        $columns = [
            ['key' => 'quotation_number', 'type' => 'text'],
            ['key' => 'quotation_date', 'type' => 'date'],
            ['key' => 'customer.name', 'type' => 'text'],
            ['key' => 'total_amount', 'type' => 'number'],
            ['key' => 'quotation_status', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'quotations.edit',
                'delete_route' => 'quotations.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('quotation.quotationNumber') }}</x-table-header>
            <x-table-header>{{ __('quotation.quotationDate') }}</x-table-header>
            <x-table-header>{{ __('quotation.customerName') }}</x-table-header>
            <x-table-header>{{ __('quotation.totalAmount') }}</x-table-header>
            <x-table-header>{{ __('quotation.quotationStatus') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($items['data'] ?? [] as $quotation)
            <x-table-row :data="$quotation" :columns="$columns" route="quotations.show" />
        @endforeach
    </tbody>
@endsection
