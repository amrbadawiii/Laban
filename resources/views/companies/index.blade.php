@extends('layouts.index')

@section('title', __('messages.company'))
@section('header_link', route('companies.create'))

@section('subContent')

    @php
        $columns = [
            ['key' => 'name', 'type' => 'text'],
            ['key' => 'email', 'type' => 'text'],
            ['key' => 'phone', 'type' => 'text'],
            [
                'key' => 'actions',
                'type' => 'actions',
                'route' => 'companies.edit',
                'delete_route' => 'companies.destroy',
            ],
        ];
    @endphp

    <thead>
        <tr>
            <x-table-header>{{ __('company.name') }}</x-table-header>
            <x-table-header>{{ __('company.email') }}</x-table-header>
            <x-table-header>{{ __('company.phone') }}</x-table-header>
            <x-table-header>{{ __('messages.actions') }}</x-table-header>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $company)
            <x-table-row :data="$company" :columns="$columns" route="companies.show" />
        @endforeach
    </tbody>

@endsection
