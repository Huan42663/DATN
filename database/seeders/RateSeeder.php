<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Rate::create(
                [
                    'order_id' => $i,
                    'product_variant_id' => $i,
                    'user_id' => $i,
                    'star' => 5,
                    'content' => "Sản phẩm rất đẹp và chất lượng",
                ]
            );
        }
    }
}
