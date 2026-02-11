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
        Schema::create('lifting', function (Blueprint $table) {
            $table->id();
            $table->integer('bl_id')->nullable();
            $table->decimal('quantity')->nullable();
            $table->string('vehicle')->nullable();
            $table->integer('gate_pass')->nullable();
            $table->integer('sales_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifting');
    }
};
