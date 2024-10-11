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
}
