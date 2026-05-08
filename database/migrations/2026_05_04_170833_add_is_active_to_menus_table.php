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
        Schema::table('menus', function (Blueprint $table) {
            // Menambahkan kolom is_active dengan tipe boolean (true/false)
            // default(true) artinya semua menu lama otomatis dianggap "Nyala"
            $table->boolean('is_active')->default(true)->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Menghapus kolom jika migration di-rollback
            $table->dropColumn('is_active');
        });
    }
};
