@props(['text', 'route', 'type' => 'primary'])

<style>
    .large-button {
        display: inline-block;
        padding: 12px 24px;
        /* Spacing */
        font-size: 16px;
        /* Font size */
        font-weight: bold;
        /* Bold text */
        color: #ffffff;
        /* Text color */
        border-radius: 8px;
        /* Rounded corners */
        text-align: center;
        /* Center text */
        text-decoration: none;
        /* Remove underline */
        transition: background-color 0.3s ease;
        /* Smooth hover effect */
    }

    .large-button-primary {
        background-color: #007bff;
        /* Blue */
    }

    .large-button-primary:hover {
        background-color: #0056b3;
        /* Darker blue */
    }

    .large-button-secondary {
        background-color: #6c757d;
        /* Gray */
    }

    .large-button-secondary:hover {
        background-color: #495057;
        /* Darker gray */
    }

    .large-button-danger {
        background-color: #dc3545;
        /* Red */
    }

    .large-button-danger:hover {
        background-color: #a71d2a;
        /* Darker red */
    }

    /* Add more types if needed */
</style>

<a href="{{ $route }}" class="large-button large-button-{{ $type }}" {{ $attributes }}>
    {{ $text }}
</a>
