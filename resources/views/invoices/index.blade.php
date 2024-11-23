@extends('layouts.index')

@section('title', __('messages.invoice'))
@section('header_link', route('invoices.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">ID</th>
        <th class="py-2 px-4 border-b">Customer</th>
        <th class="py-2 px-4 border-b">Total</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($invoices as $invoice)
    <tr>
        <td class="py-2 px-4 border-b">{{ $invoice->id }}</td>
        <td class="py-2 px-4 border-b"><a href="{{ route('invoices.show', $invoice->id) }}" class="text-blue-500">{{ $invoice->customer_name }}</a></td>
        <td class="py-2 px-4 border-b">${{ $invoice->items->sum('total') }}</td>
        <td class="py-2 px-4 border-b">
            <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection