<?php

namespace Database\Seeders;

use App\Models\Bill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if($i>0){
                Bill::create(
                    [
                        'bill_code'=>"DATN1234".$i,
                        'order_id'=>1,
                        'order_code'=>"DATN1",
                        'amount'=>99000
                    ]
                );
            }
            
        }
    }
}
