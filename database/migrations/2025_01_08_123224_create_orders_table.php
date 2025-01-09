<?php

use App\Domain\Enums\OrderStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade'); // Link to warehouses table
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Link to customers table
            $table->string('order_number')->unique(); // Unique order identifier
            $table->date('order_date'); // Date of the order
            $table->date('delivery_date')->nullable(); // Expected delivery date
            $table->enum('order_status', [OrderStatusEnum::Cancelled->value, OrderStatusEnum::Completed->value, OrderStatusEnum::Processing->value, OrderStatusEnum::Pending->value])->default(OrderStatusEnum::Pending->value); // Order status (e.g., pending, completed, cancelled)
            $table->decimal('total_amount', 15, 2)->default(0); // Total amount for the order
            $table->text('notes')->nullable(); // Additional notes
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
