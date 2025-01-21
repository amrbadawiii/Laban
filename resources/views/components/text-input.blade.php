@props(['name', 'label', 'value' => '', 'required' => false, 'type' => 'text'])

<div>
    <label class="block text-sm font-medium text-black-700">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" step="0.01"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        {{ $required ? 'required' : '' }}>
</div>
