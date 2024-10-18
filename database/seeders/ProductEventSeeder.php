<?php

namespace Database\Seeders;

use App\Models\ProductEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if ($i > 0) {
                ProductEvent::create(
                    [
                        'product_id'=>$i,
                        'event_id'=>$i,
                        'status'=>1,
                    ]
                );
            }
        }
    }
}
