<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;
    protected $primaryKey = 'order_id';
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
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class,'order_id','order_id');
    }
}
