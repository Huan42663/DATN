<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable =[
        'voucher_id',
        'voucher_code',
        'type',
        'value',
        'quantity',
        'date_start',
        'date_end',
    ];
}
