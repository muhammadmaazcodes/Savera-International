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
        Schema::create('international_contract', function (Blueprint $table) {
            $table->id();
            $table->integer('business_id')->nullable();
            $table->integer('buyer_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->string('status',50)->default('normal');
            $table->decimal('quantity',10,4)->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('parent_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('international_contract');
    }
};
