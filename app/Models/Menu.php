<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'name',
        'description',
        'price_hot',
        'price_ice',
        'category',
        'image',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];
}
