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
        Schema::table('stocks', function (Blueprint $table) {
            DB::statement("ALTER TABLE stocks MODIFY COLUMN stock_type ENUM('inbound', 'production', 'sales', 'adjustment') NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            DB::statement("ALTER TABLE stocks MODIFY COLUMN stock_type ENUM('inbound', 'production', 'sales', 'adjustment') NOT NULL");
        });
    }
};
