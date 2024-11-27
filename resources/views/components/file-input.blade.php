@props(['name', 'label', 'placeholder' => '', 'value' => ''])

<div>
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @if ($value)
        <img src="{{ asset($value) }}" alt="Current Image" class="mt-1 block p-2 shadow-sm"
            style="width: 200px; height: auto;">
    @endif
    <input type="file" name="{{ $name }}" placeholder="{{ $placeholder }}"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
</div>
