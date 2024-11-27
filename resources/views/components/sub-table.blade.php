@props([
    'columns' => [],
    'items' => [],
    'selected' => [],
    'deleteRoute' => '',
    'updateRoute' => '',
    'addRoute' => '',
    'parent' => '',
    'parentId' => '',
])

<div class="overflow-x-auto">
    <table id="dynamic-table" class="min-w-full bg-white border border-gray-300">
        <!-- Table header -->
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                @foreach ($columns as $column)
                    <th class="py-3 px-6 text-left">{{ $column['label'] }}</th>
                @endforeach
                <th class="py-3 px-6 text-right">{{ __('messages.action') }}</th>
            </tr>
        </thead>
        <!-- Table body -->
        <tbody id="table-body" class="text-gray-600 text-sm font-light">
            @foreach ($selected as $selectedItem)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    @foreach ($columns as $column)
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                @if ($column['input'] === 'select')
                                    <select name="{{ $column['name'] }}[]" class="form-select">
                                        @foreach ($column['options'] as $optionKey => $optionValue)
                                            <option value="{{ $optionKey }}"
                                                {{ $selectedItem == $optionKey ? 'selected' : '' }}>
                                                {{ $optionValue }}
                                            </option>
                                        @endforeach
                                    </select>
                                @elseif ($column['input'] === 'text' || $column['input'] === 'number')
                                    <input type="{{ $column['input'] }}" name="{{ $column['name'] }}[]"
                                        class="form-input"
                                        value="{{ $selectedItem->{'get' . ucfirst($column['getter'])}() }}" />
                                @endif
                            </div>
                        </td>
                    @endforeach
                    <td class="py-3 px-6 text-right">
                        @if ($column['input'] === 'select')
                            <button type="button" class="text-red-500 delete-row">
                                🗑️
                            </button>
                        @elseif ($column['input'] === 'text' || $column['input'] === 'number')
                            <button type="button" class="text-red-500 delete-row"
                                data-section-id="{{ $selectedItem->getId() }}">
                                🗑️
                            </button>
                            <button type="button" class="text-blue-500 update-row"
                                data-section-id="{{ $selectedItem->getId() }}">
                                🔄
                            </button>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <button type="button" id="add-row-button" class="bg-blue-500 text-white py-2 px-4 rounded">
            {{ __('messages.add_new') }}
        </button>
    </div>
</div>

<!-- JavaScript for dynamic row handling -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('table-body');
        const addRowButton = document.getElementById('add-row-button');

        // Handle delete button
        tableBody.addEventListener('click', function(event) {
            if (event.target.closest('.delete-row')) {
                const button = event.target.closest('.delete-row');
                const sectionId = button.getAttribute('data-section-id');
                const row = button.closest('tr');

                if (confirm('Are you sure you want to delete this section?')) {
                    if (sectionId) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action =
                            `{{ route($deleteRoute, [$parent => $parentId, 'id' => '%']) }}`.replace(
                                '%', sectionId);
                        form.innerHTML = `@csrf @method('DELETE')`;
                        document.body.appendChild(form);
                        form.submit();
                    } else {
                        row.remove(); // New row, no section ID, just remove
                    }
                }
            }
        });

        // Handle update button
        tableBody.addEventListener('click', function(event) {
            if (event.target.closest('.update-row')) {
                const button = event.target.closest('.update-row');
                const sectionId = button.getAttribute('data-section-id');
                const row = button.closest('tr');

                const form = document.createElement('form');
                form.method = 'POST';
                form.action =
                    `{{ route($updateRoute, [$parent => $parentId, 'id' => 'SECTION_ID']) }}`.replace(
                        'SECTION_ID',
                        sectionId);
                form.innerHTML = `@csrf @method('PUT')`;

                // Collect all inputs from the current row
                const inputs = row.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const clonedInput = input.cloneNode(true);
                    form.appendChild(clonedInput);
                });

                document.body.appendChild(form);
                form.submit();
            }
        });
        @if ($column['input'] === 'text' || $column['input'] === 'number')
            // Handle add button
            tableBody.addEventListener('click', function(event) {
                if (event.target.closest('.add-row')) {
                    const button = event.target.closest('.add-row');
                    const sectionId = button.getAttribute('data-section-id');
                    const row = button.closest('tr');

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action =
                        `{{ route($addRoute, [$parent => $parentId, 'id' => '']) }}`;
                    form.innerHTML = `@csrf @method('PUT')`;

                    // Collect all inputs from the current row
                    const inputs = row.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        const clonedInput = input.cloneNode(true);
                        form.appendChild(clonedInput);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        @endif
        // Add new row logic
        addRowButton.addEventListener('click', function() {
            const newRow = document.createElement('tr');
            newRow.classList.add('border-b', 'border-gray-200', 'hover:bg-gray-100');

            newRow.innerHTML = `
            @foreach ($columns as $column)
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <div class="flex items-center">
                        @if ($column['input'] === 'select')
                            <select name="{{ $column['name'] }}[]" class="form-select">
                                @foreach ($column['options'] as $optionKey => $optionValue)
                                    <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                                @endforeach
                            </select>
                        @elseif ($column['input'] === 'text' || $column['input'] === 'number')
                            <input type="{{ $column['input'] }}" name="{{ $column['name'] }}[]" class="form-input" />
                        @endif
                    </div>
                </td>
            @endforeach
            <td class="py-3 px-6 text-right">
                @if ($column['input'] === 'select')
                    <button type="button" class="text-red-500 delete-row">
                        🗑️
                    </button>
                @elseif ($column['input'] === 'text' || $column['input'] === 'number')
                    <button type="button" class="text-red-500 delete-row">
                        🗑️
                    </button>
                    <button type="button" class="text-blue-500 add-row">
                        ➕
                    </button>
                @endif

            </td>
        `;

            tableBody.appendChild(newRow);
        });
    });
</script>
