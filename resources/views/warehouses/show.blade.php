@extends('layouts.index')

@section('title', 'Warehouse Details')
@section('link', 'Add Section')
@section('header_link', "{{ route('sections.create') }}")

@section('subContent')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Name:</h3>
        <p class="mt-2 text-gray-500">{{ $warehouse->name }}</p>
    </div>

    <div class="bg-white p-4 shadow rounded-lg">
        <h3 class="text-lg font-medium text-gray-700">Location:</h3>
        <p class="mt-2 text-gray-500">{{ $warehouse->location }}</p>
    </div>

    <div class="bg-white pl-4 rounded-lg">
        <div class="mt-4">
            <h3 class="text-lg font-medium text-gray-700">Sections:</h3>
            @if($sections->isEmpty())
            <p>No sections available for this warehouse.</p>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 text-center">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b">Name</th>
                            <th class="py-2 px-4 border-b">Code</th>
                            <th class="py-2 px-4 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $section->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $section->code }}</td>
                            <td class="py-2 px-4 border-b">
                                <!-- Edit Section Link -->
                                <a href="{{ route('sections.edit', $section->id) }}" class="text-blue-500 hover:underline">Edit</a>

                                <!-- Delete Section Form -->
                                <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Are you sure you want to delete this section?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

    <div class="mt-6 pl-6">
        <a href="{{ route('warehouses.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-300">
            Back to Warehouses
        </a>
    </div>
</div>

@endsection