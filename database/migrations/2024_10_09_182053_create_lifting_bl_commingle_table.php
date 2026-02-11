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
        Schema::create('lifting_bl_commingle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lifting_bl_id')
            ->constrained()
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->decimal('quantity',10,3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifting_bl_commingle');
    }
};
