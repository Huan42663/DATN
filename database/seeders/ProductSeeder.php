<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 5; $i++) { 
            Products::create(
                [
                    'product_name'=>"Product".$i,
                    'product_slug'=>"product-".$i,
                    'description'=>"sản phẩm mới nhất",
                    'product_image'=>"1234.jpg",
                    'status'=>"1"
                ]
            );
           }
    }
}
