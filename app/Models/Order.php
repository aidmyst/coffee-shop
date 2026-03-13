<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Pastikan 'customer_name' ada di dalam kotak fillable ini!
    protected $fillable = [
        'customer_name',
        'table_number',
        'items',
        'total_price',
        'note',
        'status'
    ];
}