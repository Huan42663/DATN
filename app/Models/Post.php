<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable =[
        'post_id',
        'title',
        'short_description',
        'content',
        'slug',
        'category_post_id',
    ];
    public function categoryPost(){
        return $this->belongsTo(CategoryPost::class,'category_post_id');
    }
}
