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
        Schema::create('inbound_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inbound_id')->constrained('inbounds')->onDelete('cascade'); // Link to inbound record
            $table->foreignId('product_id')->constrained('products')->onDelete('restrict'); // Link to product being received
            $table->foreignId('measurement_unit_id')->constrained('measurement_units')->onDelete('restrict'); // Link to measurement unit
            $table->decimal('quantity', 15, 2); // Quantity of the inbound item
            $table->decimal('unit_price', 10, 2); // Price per unit for the inbound item
            $table->decimal('total_price', 10, 2); // Total price for the inbound item (quantity * unit price)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inbound_items');
    }
};
