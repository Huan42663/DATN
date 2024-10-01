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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->string('fullname', 50);
            $table->string('email', 255)->unique();
            $table->string('phone', 11)->unique();
            $table->decimal('total', 10.0);
            $table->decimal('total_discount', 10.0)->nullable();
            $table->enum('method_payment', ['COD', 'banking']);
            $table->string('order_code', 50);
            $table->string('note', 255);
            $table->string('address', 255);
            $table->string('province', 50);
            $table->string('district', 50);
            $table->string('ward', 50);
            $table->string('street', 50);
            $table->string('hamlet', 50)->nullable();
            $table->enum('status', ['unconfirm', 'confirmed','shipping','delivered','received','canceled','return']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
