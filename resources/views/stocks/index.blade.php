@extends('layouts.index')

@section('title', __('messages.stocks'))
@section('header_link', '#')

@section('subContent')

    @php
        $columns = [
            ['key' => 'product.name', 'type' => 'text'],
            ['key' => 'warehouse.name', 'type' => 'text'],
            ['key' => 'credit', 'type' => 'text'],
            ['key' => 'debit', 'type' => 'text'],
            ['key' => 'measurement_unit.abbreviation', 'type' => 'text'],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('product.name') }}</x-table-header>
            <x-table-header>{{ __('warehouse.name') }}</x-table-header>
            <x-table-header>{{ __('credit') }}</x-table-header>
            <x-table-header>{{ __('debit') }}</x-table-header>
            <x-table-header>{{ __('measurement_unit.abbreviation') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($items['data'] as $stock)
            <x-table-row :data="$stock" :columns="$columns" route="stocks.index" />
        @endforeach
    </tbody>

@endsection
