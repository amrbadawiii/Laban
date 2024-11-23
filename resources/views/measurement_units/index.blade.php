@extends('layouts.index')

@section('title', __('messages.measurement_unit'))
@section('header_link', route('measurement_units.create'))

@section('subContent')

<thead>
    <tr>
        <th class="py-2 px-4 border-b">Id</th>
        <th class="py-2 px-4 border-b">Name (En)</th>
        <th class="py-2 px-4 border-b">Name (Ar)</th>
        <th class="py-2 px-4 border-b">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach ($units as $measurementUnit)
    <tr>
        <td class="py-2 px-4 border-b">{{ $measurementUnit->id }}</td>
        <td class="py-2 px-4 border-b"><a href="{{ route('measurement_units.show', $measurementUnit->id) }}" class="text-blue-500">{{ $measurementUnit->name_en }}</a></td>
        <td class="py-2 px-4 border-b">{{ $measurementUnit->name_ar }}</td>
        <td class="py-2 px-4 border-b">
            <a href="{{ route('measurement_units.edit', $measurementUnit->id) }}" class="text-yellow-500">
                {{ __('messages.edit') }}
            </a> |
            <form action="{{ route('measurement_units.destroy', $measurementUnit->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">{{ __('messages.delete') }}</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
@endsection