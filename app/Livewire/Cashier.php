<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class Cashier extends Component
{
    public $lastOrderCount = 0;

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

    public function completeOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update(['status' => 'completed']);
        }
        // Halaman akan otomatis update karena polling
    }
}
