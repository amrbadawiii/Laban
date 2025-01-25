<li class="relative sidebar-section">
    <input type="checkbox" id="{{ $id }}" class="hidden peer section-toggle">
    <label for="{{ $id }}"
        class="cursor-pointer flex items-center justify-between py-2 px-4 hover:bg-cyan-200 dark:hover:bg-gray-700">
        <span class="flex items-center">
            <i class="{{ $icon }} mr-3 ml-3 p-1"></i> {{ $text }}
        </span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </label>
    <ul class="hidden peer-checked:block pl-4 bg-cyan-300 transition-all duration-300">
        {{ $slot }}
    </ul>
</li>
