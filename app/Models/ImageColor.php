<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageColor extends Model
{
    use HasFactory;
    protected $table = 'image_color';
    protected $fillable = [
        'image_color_id',
        'image_color_name',
        'product_id',
        'color_id'
    ];
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
