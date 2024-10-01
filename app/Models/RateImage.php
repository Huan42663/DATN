<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateImage extends Model
{
    use HasFactory;
    protected $table = 'rate_image';
    protected $fillable =[
        'rate_image_id',
        'rate_id',
        'image_name',
    ];
    public function rate(){
        return $this->belongsTo(Rate::class,'rate_id');
    }
}
