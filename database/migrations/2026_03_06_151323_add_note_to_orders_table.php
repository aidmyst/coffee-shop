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
        // Gunakan Schema::table untuk MEMPERBARUI tabel yang sudah ada
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'note')) {
                $table->text('note')->nullable()->after('total_price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('note');
        });
    }
};
