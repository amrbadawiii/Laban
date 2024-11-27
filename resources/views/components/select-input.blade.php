@props(['name', 'label', 'options', 'selected' => ''])

<div>
    <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select name="{{ $name }}"
        class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rtl-select">
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
