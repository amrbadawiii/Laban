@extends('layouts.create')

@section('title', 'Invoice Details')

@section('subContent')
<div class="mb-4">
    <h3 class="text-lg font-semibold">Customer Information</h3>
    <p><strong>Name:</strong> {{ $invoice->customer_name }}</p>
    <p><strong>Address:</strong> {{ $invoice->customer_address }}</p>
    <p><strong>Mobile:</strong> {{ $invoice->customer_mobile }}</p>
</div>

<div class="mb-4">
    <h3 class="text-lg font-semibold">Invoice Items</h3>
    <table class="w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Product</th>
                <th class="border px-4 py-2">Quantity</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item->product->name }}</td>
                <td class="border px-4 py-2">{{ $item->quantity }}</td>
                <td class="border px-4 py-2">${{ $item->price }}</td>
                <td class="border px-4 py-2">${{ $item->total }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right font-bold border px-4 py-2">Grand Total:</td>
                <td class="border px-4 py-2">${{ $invoice->items->sum('total') }}</td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="mt-4">
    <a href="{{ route('invoices.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to List</a>
</div>
@endsection