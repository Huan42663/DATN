<?php

namespace Database\Seeders;

use App\Models\RateImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if ($i > 0) {
                RateImage::create(
                    [
                        'rate_id' => $i ,
                        'image_name'=>'1234.jpg',
                    ]
                );
            }
        }
    }
}
