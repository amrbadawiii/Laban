@extends('dashboard')

@section('content')

<h1 class="text-2xl font-bold">{{ __('messages.welcome') }}, {{ Auth::user()->name }}</h1>
<p class="text-gray-600">{{ __('messages.sub_text') }}</p>

<div class="grid grid-cols-4 gap-4 mt-4">
    <!-- Card 1 -->
    <div class="bg-white shadow rounded-lg p-4">
        <div class="text-xs text-blue-500">2 New</div>
        <div class="text-lg font-semibold">New Orders</div>
        <div class="text-2xl font-bold text-gray-700">2,837.90 SAR</div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow rounded-lg p-4">
        <div class="text-xs text-blue-500">2 New</div>
        <div class="text-lg font-semibold">Overdue Invoices</div>
        <div class="text-2xl font-bold text-gray-700">2,837.90 SAR</div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow rounded-lg p-4">
        <div class="text-xs text-blue-500">2 New</div>
        <div class="text-lg font-semibold">Today's Quotations</div>
        <div class="text-2xl font-bold text-gray-700">2,837.90 SAR</div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white shadow rounded-lg p-4">
        <div class="text-xs text-orange-500">2 New</div>
        <div class="text-lg font-semibold">In Review Quotations</div>
        <div class="text-2xl font-bold text-orange-500">2,837.90 SAR</div>
    </div>
</div>

<div class="mt-8 grid grid-cols-2 gap-4">
    <!-- Today's Invoices -->
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-lg font-semibold">Today's Invoices</h3>
        <p class="text-xs text-gray-500">This data is reported every day</p>
        <ul class="mt-4 space-y-2">
            <li class="flex justify-between items-center">
                <span>INV-U7263</span>
                <span class="text-green-500">Paid</span>
                <span>Maxfter Inc.</span>
                <a href="#" class="text-blue-500">View</a>
            </li>
            <li class="flex justify-between items-center">
                <span>INV-U7264</span>
                <span class="text-red-500">Refunded</span>
                <span>Jim Green</span>
                <a href="#" class="text-blue-500">View</a>
            </li>
            <li class="flex justify-between items-center">
                <span>INV-U7265</span>
                <span class="text-blue-500">Credit</span>
                <span>Joe Black</span>
                <a href="#" class="text-blue-500">View</a>
            </li>
        </ul>
    </div>

    <!-- Total Transactions -->
    <div class="bg-white shadow rounded-lg p-4">
        <h3 class="text-lg font-semibold">Total transactions</h3>
        <p class="text-xs text-gray-500">last 30 days</p>
        <div class="mt-4">
            <div class="flex justify-between items-center">
                <span>Total orders</span>
                <span>3590</span>
            </div>
            <div class="flex justify-between items-center mt-2">
                <span>Executed orders</span>
                <span>3500</span>
            </div>
            <div class="flex justify-between items-center mt-2">
                <span>Waiting orders</span>
                <span>90</span>
            </div>
        </div>
        <div class="mt-4">
            <canvas id="transactionsChart"></canvas>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('transactionsChart').getContext('2d');
    const transactionsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Transactions',
                data: [10, 20, 30, 40, 50, 60, 70],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
@endsection