@props(['name', 'label', 'checked' => false, 'required' => false])

<div class="form-group flex items-center">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="1"
        {{ old($name, $checked ?? false) ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
    <label for="{{ $name }}" class="ml-2">{{ $label }}</label>
</div>
