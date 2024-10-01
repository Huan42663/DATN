<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable =[
        'order_detail_id',
        'order_id',
        'product_variant_id',
        'price',
        'sale_price',
        'quantity'
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function productVariant(){
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
}
