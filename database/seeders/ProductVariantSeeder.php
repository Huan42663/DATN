<?php

namespace Database\Seeders;

use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if ($i > 0) {
                ProductVariant::create(
                    [
                        'size_id'=>$i,
                        'color_id'=>$i,
                        'product_id'=>$i,
                        'price'=>100000,
                        'sale_price'=>99000,
                        'quantity'=>10,
                        'weight'=>0.1,
                    ]
                );
            }
        }
    }
}
