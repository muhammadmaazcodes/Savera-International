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
        Schema::create('inventory_bls', function (Blueprint $table) {
            $table->id();
            $table->string('bl_number');
            $table->string('index_number');
            $table->decimal('bl_quantity', 10, 3);
            $table->bigInteger('provisional_price',50)->nullable();
            $table->date('date')->nullable();
            $table->decimal('landed_quantity', 10, 4);
            $table->integer('status')->default(0);

            $table->foreignId('inventory_id')->constrained()
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_bls');
    }
};
