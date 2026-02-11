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
        Schema::create('contract_local', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('bussiness_id')->nullable();
            $table->integer('buyer_id')->nullable();
            $table->integer('inventory_id')->nullable();
            $table->string('type')->default('normal');
            $table->integer('return_product')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('rate')->nullable();
            $table->integer('selling_price')->nullable();
            $table->decimal('provisional_price')->nullable();
            $table->integer('final_price')->nullable();
            $table->date('lifting_date')->nullable();
            $table->integer('payment_term')->nullable();
            $table->decimal('fx_rate')->nullable();
            $table->string('code', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_local');
    }
};
