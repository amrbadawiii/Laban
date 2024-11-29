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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Supplier Name
            $table->string('email')->nullable()->unique(); // Supplier Email
            $table->string('phone')->nullable()->unique(); // Supplier Phone
            $table->string('address')->nullable(); // Supplier Address
            $table->string('city')->nullable(); // Supplier City
            $table->boolean('is_active')->default(true); // Is Active Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
