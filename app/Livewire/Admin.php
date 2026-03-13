<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class Admin extends Component
{
    public $date;

    public function mount()
    {
        $this->date = request('date', now('Asia/Jakarta')->format('Y-m-d'));
    }

    public function getOrdersProperty()
    {
        return Order::whereDate('created_at', $this->date ?: now('Asia/Jakarta')->format('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin', [
            'orders' => $this->orders
        ]);
    }
}
