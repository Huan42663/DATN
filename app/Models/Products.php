<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    protected $fillable =[
        'product_id',
        'product_name',
        'product_slug',
        'description',
        'product_image',
        'status'
    ];  
}
