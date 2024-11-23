<!-- Desktop Sidebar -->

<div id="sidebar" class="w-1/5 bg-white text-gray-900 min-h-screen p-3 {{ app()->getLocale() == 'ar' ? 'order-last' : 'order-first' }}">
    <!-- Profile Section -->
    <div class="text-center mb-8">
        <img src="{{ asset('images/pp.jpg') }}" alt="Profile Picture" class="rounded-full w-20 mx-auto">
        <h3 class="mt-4 text-lg font-semibold">{{ Auth::user()->name }}</h3>
        <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-10">
        <ul>
            <x-sidebar-item href="/" icon="fas fa-tachometer-alt" :text="__('messages.dashboard')" />

            <x-sidebar-section id="warehouses-toggle" icon="fas fa-warehouse" :text="__('messages.warehouse')">
                <x-sidebar-subitem href="{{ route('warehouses.index') }}" icon="fas fa-list" :text="__('messages.warehouse_list')" />
                <x-sidebar-subitem href="#" icon="fas fa-boxes" :text="__('messages.stock_list')" />
                <x-sidebar-subitem href="{{ route('inbounds.index') }}" icon="fas fa-truck-loading" :text="__('messages.inbound')" />
            </x-sidebar-section>

            <x-sidebar-section id="products-toggle" icon="fas fa-box" :text="__('messages.product')">
                <x-sidebar-subitem href="{{ route('products.index') }}" icon="fas fa-box-open" :text="__('messages.product')" />
                <x-sidebar-subitem href="{{ route('categories.index') }}" icon="fas fa-tags" :text="__('messages.category')" />
                <x-sidebar-section id="measurement-toggle" icon="fas fa-ruler" :text="__('messages.measurement')">
                    <x-sidebar-subitem href="{{ route('measurement_units.index') }}" icon="fas fa-ruler-combined" :text="__('messages.measurement_unit')" />
                    <x-sidebar-subitem href="{{ route('measurement_codes.index') }}" icon="fas fa-ruler-vertical" :text="__('messages.measurement_code')" />
                </x-sidebar-section>
            </x-sidebar-section>

            <x-sidebar-section id="contacts-toggle" icon="fas fa-address-book" :text="__('messages.contact')">
                <x-sidebar-subitem href="{{ route('customers.index') }}" icon="fas fa-user-friends" :text="__('messages.customer')" />
                <x-sidebar-subitem href="{{ route('suppliers.index') }}" icon="fas fa-truck" :text="__('messages.supplier')" />
            </x-sidebar-section>

            <x-sidebar-item href="{{ route('invoices.index') }}" icon="fas fa-file-invoice" :text="__('messages.invoice')" />

            <x-sidebar-section id="users-toggle" icon="fas fa-users" :text="__('messages.user')">
                <x-sidebar-subitem href="{{ route('users.index') }}" icon="fas fa-user" :text="__('messages.user')" />
                <x-sidebar-subitem href="{{ route('roles.index') }}" icon="fas fa-user-tag" :text="__('messages.role')" />
                <x-sidebar-subitem href="{{ route('permissions.index') }}" icon="fas fa-user-lock" :text="__('messages.permission')" />
            </x-sidebar-section>
        </ul>
    </nav>
</div>