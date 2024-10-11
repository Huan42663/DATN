<?php

namespace Database\Seeders;

use App\Models\ImageColor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            
                ImageColor::create(
                    [
                        'image_color_name'=>"123.jpg",
                        'product_id'=>$i,
                        'color_id'=>$i
                    ]
                );

        }
    }
}
