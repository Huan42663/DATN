<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'order_detail';
    protected $fillable =[
        'order_detail_id',
        'order_id',
        'product_id',
        'size',
        'color',
        'price',
        'sale-price',
        'quantity'
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
