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
        Schema::create('consumable_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_product_id')->constrained()->onDelete('cascade');
            $table->foreignId('consumable_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 10, 2)->nullable();
            $table->timestamps(); // Opcional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumable_product');
    }
};
