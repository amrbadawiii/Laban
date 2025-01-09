<?php

use App\Domain\Enums\QuotationStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade'); // Link to warehouses table
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // Link to customers table
            $table->string('quotation_number')->unique(); // Unique quotation identifier
            $table->date('quotation_date'); // Date of the quotation
            $table->date('expiry_date')->nullable(); // Expiry date for the quotation
            $table->enum('quotation_status', [QuotationStatusEnum::Accepted->value, QuotationStatusEnum::Draft->value, QuotationStatusEnum::Rejected->value, QuotationStatusEnum::Sent->value])->default(QuotationStatusEnum::Draft->value); // Quotation status (e.g., draft, sent, accepted, rejected)
            $table->decimal('total_amount', 15, 2)->default(0); // Total amount for the quotation
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
        Schema::dropIfExists('quotations');
    }
};
