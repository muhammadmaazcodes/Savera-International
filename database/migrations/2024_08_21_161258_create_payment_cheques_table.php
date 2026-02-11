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
        Schema::create('payment_cheques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_payment_id')->constrained()->onDelete('cascade');
            $table->string('cheque_number',150)->nullable();
            $table->integer('amount')->length(50)->unsigned()->nullable();
            $table->date('clearing_date')->nullable();
            $table->string('remarks',150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_cheques');
    }
};
