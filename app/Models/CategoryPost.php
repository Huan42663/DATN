<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryPost extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'category_post';
    protected $fillable =[
        'category_post_id',
        'category_post_name',
        'category_post_slug',
        'showHeader',
        'showFooter'
    ];
    public function categoryPost1(){
        return $this->hasMany(Post::class,'category_post_id','category_post_id');
    }
}
