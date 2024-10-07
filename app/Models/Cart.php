<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'carts';
    protected $fillable = [
        'cart_id',
        'user_id'
    ];

    public function product(){
        return $this->belongsTo(User::class,foreignKey: 'user_id');
    }
}
