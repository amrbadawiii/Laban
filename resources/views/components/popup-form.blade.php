<div x-data="{ open: false }" @keydown.escape.window="open = false" x-cloak>
    <!-- Trigger Button -->
    <div>
        <button @click="open = true" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ __('messages.add_new') }}
        </button>
    </div>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 z-10 flex items-center justify-center bg-black bg-opacity-50"
        aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <!-- Modal Content -->
        <div x-show="open"
            class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
            @click.away="open = false" x-cloak>

            <!-- Header -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
                <form method="POST" action="{{ $action }}">
                    @csrf
                    <!-- Loop through input fields -->
                    <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                        @foreach ($inputs as $input)
                            <div class="mt-4">
                                @if ($input['type'] === 'select')
                                    <x-select-input :name="$input['name']" :label="$input['label']" :options="$input['options']"
                                        :selected="$input['value'] ?? null" :required="$input['required'] ?? false" />
                                @else
                                    <x-text-input :name="$input['name']" :label="$input['label']" :value="$input['value'] ?? ''"
                                        :type="$input['type']" :required="$input['required'] ?? false" />
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Centering Save Button -->
                    <div class="mt-6 flex justify-center">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="open = false" type="button"
                    class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-red-700 hover:bg-gray-50 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
