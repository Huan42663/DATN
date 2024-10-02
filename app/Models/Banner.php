<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    protected $fillable = [
        'banner_id',
        'image_name',
        'status',
        'event_id',
        'product_id',
        'link'
    ];
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }

}
