<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'category', 'stock', 'min_stock', 'unit'];

    // Relasi balik ke menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'ingredient_menu')
            ->withPivot('quantity_needed')
            ->withTimestamps();
    }
}
