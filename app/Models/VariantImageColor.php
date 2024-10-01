<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantImageColor extends Model
{
    use HasFactory;
    protected $table = 'variant_image_color';
    protected $fillable =[
        'variant_image_color_id',
        'image_color_id',
        'product_variant_id',
    ];
    public function imageColor(){
        return $this->belongsTo(ImageColor::class,'image_color_id');
    }
    public function productVariant(){
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
}
