<!-- Desktop Sidebar -->

<div id="sidebar" class="w-1/5 bg-white text-gray-900 min-h-screen p-3">
    <!-- Profile Section -->
    <div class="text-center mb-8">
        <img src="{{ asset('images/pp.jpg') }}" alt="Profile Picture" class="rounded-full w-20 mx-auto">
        <h3 class="mt-4 text-lg font-semibold">{{ Auth::user()->name }}</h3>
        <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-10">
        <ul>
            <x-sidebar-item href="{{ route('dashboard') }}" icon="fas fa-tachometer-alt" :text="__('messages.dashboard')" />

            <!-- Warehouse Management Section -->
            <x-sidebar-section id="warehouse-toggle" icon="fas fa-warehouse" :text="__('messages.warehouse_management')">
                <x-sidebar-subitem href="#" icon="fas fa-list" :text="__('messages.warehouse_list')" />
                <x-sidebar-subitem href="#" icon="fas fa-boxes" :text="__('messages.item_list')" />
                <x-sidebar-subitem href="#" icon="fas fa-truck-loading" :text="__('messages.inbound')" />
            </x-sidebar-section>

            <!-- Contacts Section -->
            <x-sidebar-section id="crm-toggle" icon="fas fa-chart-line" :text="__('messages.contacts')">
                <x-sidebar-subitem href="#" icon="fas fa-user-friends" :text="__('messages.customer')" />
                <x-sidebar-subitem href="#" icon="fas fa-building" :text="__('messages.company')" />
                <x-sidebar-subitem href="#" icon="fas fa-receipt" :text="__('messages.supplier')" />
            </x-sidebar-section>

            <!-- Inventory Management Section -->
            <x-sidebar-section id="inventory-toggle" icon="fas fa-boxes" :text="__('messages.inventory_management')">
                <x-sidebar-subitem href="#" icon="fas fa-boxes" :text="__('messages.category')" />
                <x-sidebar-section id="measure-toggle" icon="fas fa-ruler" :text="__('messages.measurement')">
                    <x-sidebar-subitem href="#" icon="fas fa-ruler" :text="__('messages.measurement_unit')" />
                    <x-sidebar-subitem href="#" icon="fas fa-code" :text="__('messages.measurement_code')" />
                </x-sidebar-section>
                <x-sidebar-subitem href="#" icon="fas fa-boxes" :text="__('messages.stock_list')" />
                <x-sidebar-subitem href="#" icon="fas fa-warehouse" :text="__('messages.stock_tracking')" />
            </x-sidebar-section>

            <!-- Manufacture Management Section -->
            <x-sidebar-section id="manufacture-toggle" icon="fas fa-industry" :text="__('messages.manufacture_management')">
                <x-sidebar-subitem href="#" icon="fas fa-cogs" :text="__('messages.production_schedule')" />
                <x-sidebar-subitem href="#" icon="fas fa-tools" :text="__('messages.machine_maintenance')" />
            </x-sidebar-section>

            <!-- Finance Management Section -->
            <x-sidebar-section id="finance-toggle" icon="fas fa-dollar-sign" :text="__('messages.finance_management')">
                <x-sidebar-subitem href="#" icon="fas fa-money-check-alt" :text="__('messages.expense_list')" />
                <x-sidebar-subitem href="#" icon="fas fa-file-contract" :text="__('messages.sales_orders')" />
                <x-sidebar-subitem href="#" icon="fas fa-chart-bar" :text="__('messages.invoice')" />
            </x-sidebar-section>

            <!-- Reports Section -->
            <x-sidebar-section id="reports-toggle" icon="fas fa-chart-pie" :text="__('messages.report')">
                <x-sidebar-subitem href="#" icon="fas fa-file-alt" :text="__('messages.sales_report')" />
                <x-sidebar-subitem href="#" icon="fas fa-file-invoice-dollar" :text="__('messages.expense_report')" />
            </x-sidebar-section>

            <x-sidebar-section id="users-toggle" icon="fas fa-users" :text="__('messages.user')">
                <x-sidebar-subitem href="#" icon="fas fa-user" :text="__('messages.user')" />
            </x-sidebar-section>
        </ul>
    </nav>
</div>
