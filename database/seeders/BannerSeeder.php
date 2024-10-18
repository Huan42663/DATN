<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 5; $i++) {
            Banner::create(
                [
                    'image_name'=>"123.jpg",
                    'status'=>1,
                    'event_id'=>$i,
                    'product_id'=>$i,
                    'link'=>'product'
                ]
            );
        }
    }
}
