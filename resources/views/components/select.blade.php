@props(['name', 'label', 'options' => [], 'selected' => null, 'required' => false])

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
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
