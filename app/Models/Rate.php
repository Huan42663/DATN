<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'rates';
    protected $primaryKey = 'rate_id';
    protected $fillable =[
        'rate_id',
        'order_id',
        'product_variant_id',
        'user_id',
        'star',
        'content'
    ];
    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
    public function productVariant(){
        return $this->belongsTo(ProductVariant::class,'product_variant_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function images()
    {
        return $this->hasMany(RateImage::class, 'rate_id'); 
    }

   
}
