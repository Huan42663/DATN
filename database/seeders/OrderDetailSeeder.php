<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            OrderDetail::create(
                [
                    'order_id' => $i,
                    'product_variant_id' => $i,
                    'price' => 100000,
                    'sale_price' => 99000,
                    'quantity' => 1
                ]
            );
        }
    }
}

