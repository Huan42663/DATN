<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <=5; $i++) {
                CategoryProduct::create(
                    [
                        'category_id'=>$i,
                        'product_id'=>$i,
                    ]
                );
        }
    }
}
