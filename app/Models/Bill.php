<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';

    protected $fillable = [
        'bill_id',
        'bill_code',
        'order_id',
        'order_code',
        'amount'
    ];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
