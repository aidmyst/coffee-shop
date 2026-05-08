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
        'is_active' // <-- Tambahkan is_active di sini
    ];

    protected $casts = [
        'is_active' => 'boolean', // <-- Ubah juga cast-nya jadi is_active
    ];

    // Relasi ke bahan baku (Resep)
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_menu')
            ->withPivot('quantity_needed')
            ->withTimestamps();
    }

    // Fungsi otomatis cek "Apakah menu ini bisa dibuat?"
    public function getIsAvailableAttribute()
    {
        // 1. Cek saklar utama (Tombol Admin)
        // Pastikan kita mengecek nilai fisik '0' atau 'false'. 
        // Jika null (kolom belum ada), abaikan (anggap true/nyala).
        if ($this->is_active === 0 || $this->is_active === false) {
            return false;
        }

        // 2. Jika tombol nyala, lanjut cek otomatis resep & stok bahan
        if ($this->ingredients->isEmpty()) {
            return false;
        }

        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->stock < $ingredient->pivot->quantity_needed) {
                return false;
            }
        }

        return true;
    }
}
