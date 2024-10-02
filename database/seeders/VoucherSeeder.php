<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i <5 ; $i++) { 
            Voucher::create(
                [
                    'voucher_code'=>"DATN".$i,
                    'type'=>0,
                    'value'=>10,
                    'quantity'=>10,
                    'date_start'=>"2024-10-01 13:48:47",
                    'date_end'=>"2024-10-05 13:48:47",
                ]
                );
        }
    }
}
