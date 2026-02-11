<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_request', function (Blueprint $table) {
            $table->id();
            $table->integer('buyer_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('inventory_id')->nullable();
            $table->integer('status')->default(0);
            $table->decimal('quantity',10,4)->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('gate_pass')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_request');
    }
};
