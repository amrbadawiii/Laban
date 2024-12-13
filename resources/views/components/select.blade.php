@props([
    'name',
    'label',
    'options' => [], // Array of key-value pairs or objects
    'selected' => null,
    'required' => false,
    'displayKey' => 'name', // Key used to display text in the dropdown for objects
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'form-select mt-1 block w-full']) }}>
        <option value="">{{ __('Select an option') }}</option>
        @foreach ($options as $key => $value)
            @php
                $optionValue = is_array($value) ? $value['id'] : $key; // Determine the value
                $displayValue =
                    is_array($value) && isset($value[$displayKey]) ? $value[$displayKey] : $value['abbreviation']; // Use displayKey for text
            @endphp
            <option value="{{ $optionValue }}" {{ (string) $optionValue === (string) $selected ? 'selected' : '' }}>
                {{ $displayValue }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
