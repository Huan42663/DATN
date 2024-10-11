<?php

namespace Database\Seeders;

use App\Models\CartDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            CartDetail::create(
                [
                    'cart_id' => $i,
                    'product_variant_id' => $i,
                    'quantity' => 1
                ]
            );
        }
    }
}
