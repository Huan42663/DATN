git branch -a<?php

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
                        Schema::create('image_color', function (Blueprint $table) {
                            $table->id('image_color_id');
                            $table->string('image_color_name', 50);
                            $table->foreignId('product_id')->constrained('products', 'product_id');
                            $table->foreignId('color_id')->constrained('colors', 'color_id');
                            $table->timestamps();
                        });
                    }

                    /**
                     * Reverse the migrations.
                     */
                    public function down(): void
                    {
                        Schema::dropIfExists('image_color');
                    }
                };
