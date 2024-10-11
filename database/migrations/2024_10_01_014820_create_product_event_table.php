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
        Schema::create('product_event', function (Blueprint $table) {
            $table->id('product_event_id');
            $table->foreignId('product_id')->constrained('products', 'product_id');
            $table->foreignId('event_id')->constrained('events', 'event_id');
            $table->tinyInteger('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_event');
    }
};
