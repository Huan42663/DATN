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
        for ($i = 0; $i < 5; $i++) {
            if ($i > 0) {
                Rate::create(
                    [
                        'order_id'=>1,
                        'product_variant_id'=>1,
                        'user_id'=>1,
                        'star'=>5,
                        'content'=>"Sản phẩm rất đẹp và chất lượng",
                    ]
                );
            }
        }
    }
}
