<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable =[
        'order_id',
        'fullname',
        'email',
        'phone',
        'total',
        'total_discount',
        'method_payment',
        'order_code',
        'user_id',
        'note',
        'address',
        'province',
        'district',
        'ward',
        'street',
        'hamlet',
        'status'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
