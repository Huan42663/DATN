<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'category_product';
    protected $fillable =[
        'category_product_id',
        'category_id',
        'product_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function products(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
