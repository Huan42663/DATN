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
        Schema::create('product_variant', function (Blueprint $table) {
            $table->id('product_variant_id');
            $table->foreignId('size_id')->constrained('sizes', 'size_id');
            $table->foreignId('color_id')->constrained('colors', 'color_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->decimal('price', 10.0);
            $table->decimal('sale_price', 10.0)->nullable();
            $table->integer('quantity');
            $table->float('weight');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant');
    }
};
