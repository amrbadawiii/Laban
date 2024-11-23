<x-app-layout>
    <div class="flex">
        <div class="w-full bg-gray-100 p-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-1">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-bold">@yield('title', 'Default Title')</h2>
                        @yield('subContent')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>