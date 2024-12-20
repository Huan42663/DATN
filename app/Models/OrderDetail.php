<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'order_detail';
    protected $fillable = [
        'order_detail_id',
        'order_id',
        'product_id',
        'size',
        'color',
        'price',
        'sale_price',
        'quantity'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id')->withTrashed();
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id')->withTrashed();
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id')->withTrashed();
    }
}
