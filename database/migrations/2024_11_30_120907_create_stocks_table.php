<?php

use App\Domain\Enums\StockTypeEnum;
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
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->foreignId('measurement_unit_id')->constrained('measurement_units')->onDelete('cascade');
            $table->decimal('incoming', 10, 2)->default(0);
            $table->decimal('outgoing', 10, 2)->default(0);
            $table->enum('stock_type', [StockTypeEnum::Production->value, StockTypeEnum::Sales->value, StockTypeEnum::Adjustment->value])->default(StockTypeEnum::Adjustment->value);
            $table->nullableMorphs('reference');
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
