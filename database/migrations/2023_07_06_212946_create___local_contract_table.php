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
        Schema::create('local_contract', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id');
            $table->integer('buyer_id');
            $table->integer('product_id');
            $table->integer('inventory_id');
            $table->bigInteger('quantity');
            $table->string('reference');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_contract');
    }
};
