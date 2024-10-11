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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id');
            $table->foreignId('product_variant_id')->constrained('product_variant', 'product_variant_id');
            $table->decimal('price', 10.0);
            $table->decimal('sale_price', 10.0)->nullable();
            $table->integer('quantity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
