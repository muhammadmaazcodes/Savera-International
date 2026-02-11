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
        Schema::create('sales_contract', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id')->nullable();
            $table->integer('contract_id')->nullable();
            $table->decimal('quantity',10,4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_contract');
    }
};
