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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Links to products
            $table->decimal('credit', 10, 2); // Tracks the stock quantity
            $table->decimal('debit', 10, 2); // Tracks the stock quantity
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade'); // Links to specific warehouses
            $table->foreignId('measurement_unit_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
