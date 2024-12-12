@extends('layouts.index')

@section('title', __('messages.measurementUnit'))
@section('header_link', route('measurementUnits.create'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'name_en', 'type' => 'text'],
            ['key' => 'name_ar', 'type' => 'text'],
            ['key' => 'abbreviation', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'measurementUnits.edit',
                'delete_route' => 'measurementUnits.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('measurementUnit.name_en') }}</x-table-header>
            <x-table-header>{{ __('measurementUnit.name_ar') }}</x-table-header>
            <x-table-header>{{ __('measurementUnit.abbreviation') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($items['data'] as $unit)
            <x-table-row :data="$unit" :columns="$columns" route="measurementUnits.show" />
        @endforeach
    </tbody>

@endsection
