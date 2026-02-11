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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->string('voyage_number')->nullable();
            $table->decimal('bl_quantity', 10, 3)->nullable();
            $table->decimal('landed_quantity', 10, 4)->nullable();
            $table->date('igm_date')->nullable();
            $table->date('arrival_date')->nullable();
            $table->string('status')->nullable();
            $table->integer('contract_id')->nullable();
            $table->integer('buyer_id')->nullable();

            $table->foreignId('product_id')->constrained()
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->foreignId('company_id')->constrained()
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->foreignId('vessel_id')->constrained()
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->foreignId('terminal_id')->constrained()
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->foreignId('clearing_agent_id')->constrained()
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->foreignId('surveyor_id')->constrained()
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
        Schema::dropIfExists('inventories');
    }
};
