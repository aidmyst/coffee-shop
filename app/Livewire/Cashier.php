<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class Cashier extends Component
{
    public $lastOrderCount = 0;

    public $isFirstLoad = true;

    public function render()
    {
        // Ambil data pesanan yang sudah dibayar (processing)
        $orders = Order::where('status', 'processing')
            ->orderBy('created_at', 'desc')
            ->get();

        // Logika Suara: Jika jumlah pesanan bertambah
        if (!$this->isFirstLoad && $orders->count() > $this->lastOrderCount) {
            $this->dispatch('play-notification-sound');
        }

        $this->lastOrderCount = $orders->count();
        $this->isFirstLoad = false;

        return view('livewire.cashier', [  // Ini harus sesuai dengan lokasi file .blade.php
            'orders' => $orders
        ]);
    }

    // Fungsi saat tombol "Konfirmasi ➜" diklik di tabel
    public function confirmComplete($id)
    {
        $order = Order::find($id);
        
        if ($order) {
            // 1. Ambil data item pesanan dari format JSON
            $items = json_decode($order->items);

            // 2. Lakukan pengurangan stok bahan baku
            if (!empty($items)) {
                foreach ($items as $item) {
                    $menu = \App\Models\Menu::where('name', $item->name ?? $item->nama_menu)->first();

                    if ($menu) {
                        $qty = $item->qty ?? $item->quantity ?? 1;
                        foreach ($menu->ingredients as $ingredient) {
                            $totalNeeded = $qty * $ingredient->pivot->quantity_needed;
                            $ingredient->decrement('stock', $totalNeeded);
                        }
                    }
                }
            }

            // JALUR NINJA KE GOOGLE SHEETS
            try {
                $spreadsheetId = env('POST_SPREADSHEET_ID');
                if ($spreadsheetId) {
                    $client = new \Google\Client();
                    $client->setAuthConfig(storage_path('app/google-access.json'));
                    $client->addScope(\Google\Service\Sheets::SPREADSHEETS);
                    $service = new \Google\Service\Sheets($client);

                    $menuDetails = "";
                    $cartItems = is_string($order->items) ? json_decode($order->items, true) : $order->items;
                    if (!empty($cartItems)) {
                        foreach ($cartItems as $item) {
                            $jumlah = $item['quantity'] ?? $item['qty'] ?? 1;
                            $namaMenu = $item['name'] ?? 'Menu';
                            $opsi = isset($item['option']) && $item['option'] !== '' ? " (" . $item['option'] . ")" : "";
                            $sugar = isset($item['sugar']) && $item['sugar'] !== '' ? " [" . $item['sugar'] . "]" : "";
                            $menuDetails .= $namaMenu . $opsi . $sugar . " (x" . $jumlah . ")\n";
                        }
                    }

                    $labelIdentitas = $order->customer_name ? $order->customer_name . " (Meja " . $order->table_number . ")" : "Meja " . $order->table_number;

                    $values = [[
                        $order->updated_at->format('d-m-Y H:i'),
                        $labelIdentitas,
                        $order->total_price,
                        trim($menuDetails),
                        $order->note ?? '-',
                    ]];

                    $body = new \Google\Service\Sheets\ValueRange(['values' => $values]);
                    $service->spreadsheets_values->append($spreadsheetId, 'Sheet1', $body, ['valueInputOption' => 'RAW']);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Jalur Ninja Error: ' . $e->getMessage());
            }

            // 3. Ubah status pesanan menjadi completed
            $order->update(['status' => 'completed']);
        }
    }

    // Fungsi saat tombol "Batal" diklik di tabel
    public function cancelOrder($id)
    {
        $order = Order::find($id);
        
        if ($order) {
            $order->delete();
        }
    }
}
