@props(['label', 'value', 'valueTwo' => null])

<p class="mt-2 text-gray-500">
    <strong>{{ $label }}:</strong>
    @php
        // Ensure $value is a string before processing for URL
        $stringValue = $value instanceof \DateTime ? $value->format('Y-m-d') : (string) $value;

        // Check if the value is a URL and prepend "https://" if it starts with 'www.'
        $url =
            filter_var($stringValue, FILTER_VALIDATE_URL) || preg_match('/^www\./', $stringValue)
                ? (preg_match('/^http(s)?:\/\//', $stringValue)
                    ? $stringValue
                    : 'https://' . $stringValue)
                : null;
    @endphp

    @if ($url)
        <a href="{{ $url }}" target="_blank" class="text-indigo-600 hover:underline">
            {{ $stringValue }} @if ($valueTwo)
                - {{ $valueTwo }}
            @endif
        </a>
    @else
        {{ $stringValue }} @if ($valueTwo)
            - {{ $valueTwo }}
        @endif
    @endif
</p>
