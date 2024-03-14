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
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->decimal('quantity');
            $table->decimal('amount');
            $table->string('name_product');
            $table->decimal('expense_product');
            $table->decimal('price_product');
            $table->foreignId('id_sale');
            $table->foreign('id_sale')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_product')->nullable();
            $table->foreign('id_product')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_products');
    }
};
