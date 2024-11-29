<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{
    use HasFactory;
    protected $table = 'post_image';
    protected $primaryKey = 'post_image_id';
    protected $fillable =[
        'post_image_id',
        'image_name',
        'post_id',
    ];
    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
