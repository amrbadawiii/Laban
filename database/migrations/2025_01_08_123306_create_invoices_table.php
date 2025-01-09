<?php

use App\Domain\Enums\InvoiceStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade'); // Link to warehouses table
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Link to customers table
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('set null'); // Link to an order (optional)
            $table->string('invoice_number')->unique(); // Unique invoice identifier
            $table->date('invoice_date'); // Date of the invoice
            $table->date('due_date')->nullable(); // Payment due date
            $table->enum('invoice_status', [InvoiceStatusEnum::Cancelled->value, InvoiceStatusEnum::Overdue->value, InvoiceStatusEnum::Paid->value, InvoiceStatusEnum::Unpaid->value])->default(InvoiceStatusEnum::Unpaid->value); // Invoice status (e.g., unpaid, paid, overdue)
            $table->decimal('total_amount', 15, 2)->default(0); // Total amount for the invoice
            $table->decimal('paid_amount', 15, 2)->default(0); // Amount paid
            $table->decimal('balance_due', 15, 2)->default(0); // Balance amount due
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
        Schema::dropIfExists('invoices');
    }
};
