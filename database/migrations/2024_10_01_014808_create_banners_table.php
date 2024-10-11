<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id('banner_id');
            $table->string('image_name', 255);
            $table->tinyInteger('status');
            $table->foreignId('event_id')->nullable()->constrained('events', 'event_id');
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id');
            $table->text('link');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
