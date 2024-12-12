@extends('layouts.index')

@section('title', __('messages.stocks'))

@section('content')
    <h1>{{ __('messages.stocks') }}</h1>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>{{ __('messages.product') }}</th>
                <th>{{ __('messages.warehouse') }}</th>
                <th>{{ __('messages.credit') }}</th>
                <th>{{ __('messages.debit') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $stock)
                <tr>
                    <td>{{ $stock['product']['name'] }}</td>
                    <td>{{ $stock['warehouse']['name'] }}</td>
                    <td>{{ $stock['credit'] }}</td>
                    <td>{{ $stock['debit'] }}</td>
                    <td>
                        <a href="{{ route('stocks.show', $stock['product_id']) }}" class="text-blue-500 hover:underline">
                            {{ __('messages.view') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
