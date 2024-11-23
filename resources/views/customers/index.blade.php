@extends('layouts.index')

@section('title', __('messages.customer'))
@section('header_link', route('customers.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Address</th>
        <th class="py-2 px-4 border-b">Mobile Number</th>
        <th class="py-2 px-4 border-b">Code</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($customers as $customer)
    <tr>
        <td class="py-2 px-4 border-b"><a href="{{ route('customers.show', $customer->id) }}" class="text-blue-500">{{ $customer->name }}</a></td>
        <td class="py-2 px-4 border-b">{{ $customer->address }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->mobile_number }}</td>
        <td class="py-2 px-4 border-b">{{ $customer->code }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('customers.edit', $customer->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection