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
        for ($i = 4; $i <=5; $i++) {
                Bill::create(
                    [
                        'bill_code'=>"DATN1234".$i,
                        'order_id'=>$i,
                        'order_code'=>"DATN1",
                        'amount'=>99000
                    ]
                );
            }
            
        }
    }
