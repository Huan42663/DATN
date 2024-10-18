<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if ($i >= 1) {
                Category::create(
                    [
                        'category_name' => "Áo Nam" . $i,
                        'category_parent_id' => "1",
                    ]
                );
            } else {
                Category::create(
                    [
                        'category_name' => "Áo Nam",
                    ]
                );
            }
        }
    }
}
