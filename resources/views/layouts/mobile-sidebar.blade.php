<!-- Mobile Sidebar -->
<div id="mobile-sidebar"
    class="fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-30 w-64 bg-white dark:bg-gray-900 shadow-lg h-screen overflow-y-auto lg:hidden">
    <!-- Profile Section -->
    <div class="text-center mb-8">
        <img src="{{ asset('images/pp.jpg') }}" alt="Profile Picture" class="rounded-full w-20 mx-auto">
        <h3 class="mt-4 text-lg font-semibold">{{ Auth::user()->name }}</h3>
        <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
    </div>

    <!-- Mobile Navigation Links -->
    <nav class="mt-10">
        <ul>
            <x-mobile-sidebar-item href="/" icon="fas fa-tachometer-alt" :text="__('messages.dashboard')" />

            <x-mobile-sidebar-section id="mobile-warehouses-toggle" icon="fas fa-warehouse" :text="__('messages.warehouse')">
                <x-mobile-sidebar-subitem href="#" icon="fas fa-list" :text="__('messages.warehouse_list')" />
                <x-mobile-sidebar-subitem href="#" icon="fas fa-boxes" :text="__('messages.stock_list')" />
                <x-mobile-sidebar-subitem href="#" icon="fas fa-truck-loading" :text="__('messages.inbound')" />
            </x-mobile-sidebar-section>

            <x-mobile-sidebar-section id="mobile-products-toggle" icon="fas fa-box" :text="__('messages.product')">
                <x-mobile-sidebar-subitem href="#" icon="fas fa-box-open" :text="__('messages.product')" />
                <x-mobile-sidebar-subitem href="#" icon="fas fa-tags" :text="__('messages.category')" />
                <x-mobile-sidebar-section id="mobile-measurement-toggle" icon="fas fa-ruler" :text="__('messages.measurement')">
                    <x-mobile-sidebar-subitem href="#" icon="fas fa-ruler-combined" :text="__('messages.measurement_unit')" />
                    <x-mobile-sidebar-subitem href="#" icon="fas fa-ruler-vertical" :text="__('messages.measurement_code')" />
                </x-mobile-sidebar-section>
            </x-mobile-sidebar-section>

            <x-mobile-sidebar-section id="mobile-contacts-toggle" icon="fas fa-address-book" :text="__('messages.contact')">
                <x-mobile-sidebar-subitem href="#" icon="fas fa-user-friends" :text="__('messages.customer')" />
                <x-mobile-sidebar-subitem href="#" icon="fas fa-truck" :text="__('messages.supplier')" />
            </x-mobile-sidebar-section>

            <x-mobile-sidebar-item href="#" icon="fas fa-file-invoice" :text="__('messages.invoice')" />

            <x-mobile-sidebar-section id="mobile-users-toggle" icon="fas fa-users" :text="__('messages.user')">
                <x-mobile-sidebar-subitem href="#" icon="fas fa-users-cog" :text="__('messages.user')" />
                <x-mobile-sidebar-subitem href="#" icon="fas fa-user-tag" :text="__('messages.role')" />
                <x-mobile-sidebar-subitem href="#" icon="fas fa-user-lock" :text="__('messages.permission')" />
            </x-mobile-sidebar-section>
        </ul>
    </nav>
</div>

<!-- Overlay for Mobile Sidebar -->
<div id="mobile-sidebar-overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-20 hidden"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');

        // Determine the direction for RTL or LTR
        const isRtl = document.documentElement.getAttribute('dir') === 'rtl';
        const sidebarDirectionClass = isRtl ? '-translate-x-full' : '-translate-x-full';
        const sidebarShowClass = isRtl ? 'translate-x-full' : 'translate-x-0';

        // Toggle mobile sidebar visibility
        mobileSidebarToggle.addEventListener('click', () => {
            mobileSidebar.classList.toggle(sidebarShowClass); // Show sidebar
            mobileSidebar.classList.toggle(sidebarDirectionClass); // Hide sidebar
            mobileSidebarOverlay.classList.toggle('hidden'); // Show/Hide overlay
        });

        // Close mobile sidebar when clicking on the overlay
        mobileSidebarOverlay.addEventListener('click', () => {
            mobileSidebar.classList.add(sidebarDirectionClass); // Hide sidebar
            mobileSidebar.classList.remove(sidebarShowClass); // Ensure it's offscreen
            mobileSidebarOverlay.classList.add('hidden'); // Hide overlay
        });
    });
</script>
