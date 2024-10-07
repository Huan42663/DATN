<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductEvent extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'product_event';
    protected $fillable =[
        'product_event_id',
        'product_id',
        'event_id',
        'status',
    ];
    public function products(){
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}
