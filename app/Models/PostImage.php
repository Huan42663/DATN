<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $table = 'post_image';
    protected $fillable =[
        'post_image_id',
        'image_name',
        'post_id',
    ];
    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
