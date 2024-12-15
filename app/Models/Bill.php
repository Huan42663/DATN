<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'bills';

    protected $fillable = [			
        "order_id",
        "bank_code",	
        "bank_tranno",	
        "amount",
        "card_type",	
        "vnpay_transactionno",	
    ];

    // public function order(){
    //     return $this->belongsTo(Order::class,'order_id');
    // }
}
