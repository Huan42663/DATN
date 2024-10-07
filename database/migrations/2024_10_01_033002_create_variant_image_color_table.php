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
        Schema::create('variant_image_color', function (Blueprint $table) {
            $table->id('variant_image_color_id');
            $table->foreignId('image_color_id')->constrained('image_color', 'image_color_id');
            $table->foreignId('product_variant_id')->constrained('product_variant', 'product_variant_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varian_image_color');
    }
};
