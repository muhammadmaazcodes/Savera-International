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
        Schema::create('custom_payments', function (Blueprint $table) {
            $table->id();
            $table->string('type',50)->nullable();
            $table->string('customer_number',100)->nullable();
            $table->string('customer_name',150)->nullable();
            $table->date('posting_date')->nullable();
            $table->foreignId('inventory_id')->constrained()->onDelete('cascade');
            $table->string('bank_title',100)->nullable();
            $table->string('ibft',100)->nullable();
            $table->foreignId('bank_id')->constrained()->onDelete('cascade');
            $table->string('deposit_slip_number',100)->nullable();
            $table->date('stamp_date')->nullable();
            $table->string('attachment_deposit_slip',100)->nullable();
            $table->integer('amount')->unsigned()->length(50)->nullable();
            $table->text('remarks')->nullable();
            $table->text('hawala_party_name')->nullable();
            $table->string('status',50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_payments');
    }
};
