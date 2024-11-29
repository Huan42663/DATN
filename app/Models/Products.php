<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name',
        'product_slug',
        'description',
        'product_image',
        'status'
    ];


    public function rates()
    {
        return $this->hasMany(Rate::class, 'product_variant_id', 'product_variant_id');
    }
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
    // public function productEvent()
    // {
    //     return $this->hasMany(ProductEvent::class);
    // }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'product_event');
    }
    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_event');
    }

    public function size()
{
    return $this->belongsTo(Size::class, 'size_id', 'size_id');
}

public function color()
{
    return $this->belongsTo(Color::class, 'color_id', 'color_id');
}
}
