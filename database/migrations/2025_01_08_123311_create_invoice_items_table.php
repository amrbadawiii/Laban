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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade'); // Link to invoices
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Link to products
            $table->foreignId('measurement_unit_id')->constrained('measurement_units')->onDelete('restrict'); // Link to measurement unit
            $table->decimal('quantity', 15, 2); // Quantity billed
            $table->decimal('unit_price', 15, 2); // Price per unit
            $table->decimal('total_price', 15, 2); // Total price for this item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
