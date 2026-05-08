<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class Cashier extends Component
{
    public $lastOrderCount = 0;

    // Properti baru untuk Modal Nota
    public $selectedOrder = null;
    public $showReceiptModal = false;

    public function render()
    {
        // Ambil data pesanan pending
        $orders = Order::where('status', 'pending')->orderBy('created_at', 'desc')->get();

        // Logika Suara: Jika jumlah pesanan bertambah
        if ($orders->count() > $this->lastOrderCount) {
            if ($this->lastOrderCount > 0) {
                // Ganti dispatchBrowserEvent menjadi dispatch
                $this->dispatch('play-notification-sound');
            }
        }

        $this->lastOrderCount = $orders->count();

        return view('livewire.cashier', [  // Ini harus sesuai dengan lokasi file .blade.php
            'orders' => $orders
        ]);
    }

    // 1. Fungsi saat tombol "Konfirmasi ➜" diklik di tabel
    public function confirmComplete($id)
    {
        $this->selectedOrder = Order::find($id);
        $this->showReceiptModal = true;
    }

    // 2. Fungsi saat tombol "Batal" diklik di dalam modal
    public function cancelConfirm()
    {
        $this->showReceiptModal = false;
        $this->selectedOrder = null;
    }

    // 3. Fungsi saat tombol "Konfirmasi & Cetak" diklik di dalam modal
    public function processAndPrint()
    {
        if ($this->selectedOrder) {

            // 1. Ambil data item pesanan dari format JSON
            $items = json_decode($this->selectedOrder->items);

            // 2. Lakukan pengurangan stok bahan baku
            foreach ($items as $item) {
                $menu = \App\Models\Menu::where('name', $item->name)->first();

                if ($menu) {
                    foreach ($menu->ingredients as $ingredient) {
                        $totalNeeded = $item->qty * $ingredient->pivot->quantity_needed;
                        $ingredient->decrement('stock', $totalNeeded);
                    }
                }
            }

            // 3. Ubah status pesanan menjadi completed
            $this->selectedOrder->update(['status' => 'completed']);

            // 4. Tutup modal dan bersihkan data order yang dipilih
            $this->showReceiptModal = false;
            $this->selectedOrder = null;

            // CATATAN: Baris $this->dispatch('open-print-tab' ...) DIHAPUS karena sudah print dari iframe
        }
    }
}
