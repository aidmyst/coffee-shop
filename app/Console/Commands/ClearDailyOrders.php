<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class ClearDailyOrders extends Command
{
    // Nama perintah yang akan dipanggil
    protected $signature = 'orders:clear-daily';

    // Deskripsi perintah
    protected $description = 'Menghapus semua riwayat pesanan setiap pergantian hari';

    public function handle()
    {
        // Menghapus semua data dari tabel orders
        Order::truncate();

        $this->info('Semua riwayat pesanan telah dibersihkan untuk hari baru.');
    }
}
