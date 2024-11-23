@extends('layouts.index')

@section('title', __('messages.measurement_code'))
@section('header_link', route('measurement_codes.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Id</th>
        <th class="py-2 px-4 border-b">Name</th>
        <th class="py-2 px-4 border-b">Code</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($codes as $measurementCode)
    <tr>
        <td class="py-2 px-4 border-b">{{ $measurementCode->id }}</td>
        <td class="py-2 px-4 border-b"><a href="{{ route('measurement_codes.show', $measurementCode->id) }}" class="text-blue-500">{{ $measurementCode->name }}</a></td>
        <td class="py-2 px-4 border-b">{{ $measurementCode->code }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('measurement_codes.edit', $measurementCode->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('measurement_codes.destroy', $measurementCode->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection