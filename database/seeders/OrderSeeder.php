<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            if ($i > 0) {
                Order::create(
                    [
                        'fullname' => "HelloWorld".$i,
                        'email'=>"helloworld".$i."@gmail",
                        'phone'=>"012345678".$i,
                        'total'=>99000,
                        'total_discount'=>99000,
                        'method_payment'=>"COD",
                        'order_code'=>"DATN".$i,
                        'user_id'=>$i,
                        'note'=>"Giao hàng nhanh bạn ơi cần gấp",
                        'address'=>"Số 68 Đường Hà Nội Tổ dân phố số 3",
                        'province'=>"Hà Nội",
                        'district'=>"Nam Từ Liêm",
                        'ward'=>"Phường phương canh",
                        'street'=>" Đường Hà Nội",
                        'status'=>"unconfirm"
                    ]
                );
            }
        }
    }
}
