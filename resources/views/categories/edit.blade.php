@extends('layouts.create')

@section('title', 'Edit Category')

@section('subContent')

<form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block text-sm font-medium text-gray-700">Name (English)</label>
            <input type="text" name="name_en" value="{{ $category->name_en }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Name (Arabic)</label>
            <input type="text" name="name_ar" value="{{ $category->name_ar }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Activate</label>
            <input type="number" name="activate" value="{{ $category->activate }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        <div>

        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Current Image</label>
            @if ($category->image)
            <img src="{{ asset($category->image) }}" alt="{{ $category->name_en }}" class="mt-1 block w-full p-2 shadow-sm">
            @else
            <p>No image available</p>
            @endif
        </div>
        <div>

        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Change Image</label>
            <input type="file" name="image" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
    </div>


    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Update
        </button>
    </div>
</form>
@endsection