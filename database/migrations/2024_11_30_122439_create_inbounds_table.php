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
            $table->string('reference_number')->unique(); // Unique reference number for the inbound
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null'); // Links to suppliers (if applicable)
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade'); // Links to the warehouse receiving the goods
            $table->date('received_date'); // Date the goods were received
            $table->boolean('is_confirmed')->default(false); // Confirmation status
            $table->string('invoice_number')->nullable()->index(); // Optional invoice or reference number with an index for quicker searches
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null'); // Track who created the inbound record
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null'); // Track who last updated the inbound record
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
