<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // Kopi, Susu, Sirup, dll
            $table->decimal('stock', 10, 2)->default(0); // Bisa pakai koma, misal 1.5 Liter
            $table->decimal('min_stock', 10, 2)->default(0); // Batas minimal untuk notif "Menipis"
            $table->string('unit'); // Gram, Liter, Botol, Pcs
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
