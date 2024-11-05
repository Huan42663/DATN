<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_variant';
    protected $fillable = [
        'product_variant_id',
        'size_id',
        'color_id',
        'product_id',
        'price',
        'sale_price',
        'quantity',
        'weight',
    ];




    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function rates()
    {
        return $this->hasMany(Rate::class, 'product_variant_id');
    }
}
