<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CartDetail extends Model
{
    use HasFactory;
    protected $table = 'cart_detail';
    protected $fillable =[
        'cart_detail_id',
        'cart_id',
        'product_variant_id',
        'quantity'
    ];
    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
    public function productVariant(){
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
}