@props(['name', 'label', 'value' => '', 'required' => false, 'type' => 'text'])

<div>
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        {{ $required ? 'required' : '' }}>
</div>
