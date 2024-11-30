<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inbounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Links to the product being received
            $table->foreignId('measurement_unit_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 10, 2); // Quantity received
            $table->foreignId('supplier_id')->nullable()->constrained()->onDelete('set null'); // Links to suppliers (if applicable)
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade'); // Links to the warehouse receiving the goods
            $table->date('received_date'); // Date the goods were received
            $table->boolean('is_confirmed')->default(false);
            $table->string('invoice_number')->nullable(); // Optional invoice or reference number
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbounds');
    }
};
