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
        Schema::create('rates', function (Blueprint $table) {
            $table->id('rate_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id');
            $table->foreignId('product_variant_id')->constrained('product_variant', 'product_variant_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->integer('star');
            $table->text('content')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
