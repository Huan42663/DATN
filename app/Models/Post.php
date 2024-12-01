<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $fillable =[
        'post_id',
        'title',
        'short_description',
        'content',
        'slug',
        'category_post_id',
    ];
    public function PostImage(){
        return $this->hasMany(PostImage::class,'post_id','post_id');
    }
    public function categoryPost(){
        return $this->belongsTo(CategoryPost::class,'category_post_id','category_post_id');
    }
}
