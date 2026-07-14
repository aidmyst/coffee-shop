<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pesanan Meja ' . $order->table_number . ' Selesai!');
    }

    public function adminDashboard(Request $request)
    {
        // 1. Ambil tanggal dari input 'date'. Jika kosong, default ke hari ini.
        $selectedDate = $request->input('date', now('Asia/Jakarta')->format('Y-m-d'));

        if (Auth::user()->role === 'admin') {
            // 2. Filter data hanya untuk tanggal yang dipilih dan pesanan yang sudah selesai (dikonfirmasi kasir)
            $orders = Order::whereDate('created_at', $selectedDate)
                ->where('status', 'completed')
                ->latest()
                ->get();

            // Kirim data orders dan selectedDate ke view
            return view('admin.dashboard_admin', compact('orders', 'selectedDate'));
        }

        // Kasir tetap hanya melihat yang belum selesai hari ini
        $orders = Order::whereDate('created_at', today())
            ->where('status', '!=', 'completed')
            ->latest()
            ->get();

        return view('cashier.dashboard_cashier', compact('orders'));
    }

    public function history()
    {
        // Mengambil semua pesanan yang sudah selesai (Paid/Completed)
        $orders = Order::where('status', 'completed')
            ->whereDate('created_at', today('Asia/Jakarta'))
            ->latest()
            ->get();

        // PASTIKAN baris ini mengarah ke file history, bukan dashboard_cashier
        return view('cashier.reports.history', compact('orders'));
    }

    public function exportDaily(Request $request)
    {
        // Ambil tanggal dari request, default ke hari ini
        $date = $request->query('date', now('Asia/Jakarta')->format('Y-m-d'));
        $filename = 'Laporan_Cafe_' . $date . '.xlsx';

        return Excel::download(new OrdersExport($date), $filename);
    }

    public function exportAll()
    {
        $filename = 'Laporan_Cafe_Lengkap_' . now()->format('d-M-Y') . '.xlsx';

        // Panggil OrdersExport tanpa parameter tanggal untuk ambil semua data
        return Excel::download(new OrdersExport(), $filename);
    }

    public function statistics()
    {
        // Statistik pendapatan 7 hari terakhir
        $data = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $labels = $data->pluck('date');
        $totals = $data->pluck('total');

        // ===============================
        // Statistik Menu Paling Banyak Dipesan
        // ===============================
        $orders = Order::where('status', 'completed')->get();

        $menuCount = [];

        foreach ($orders as $order) {
            $items = json_decode($order->items, true) ?? [];

            foreach ($items as $item) {

                $name = $item['name'] ?? 'Unknown';
                $qty = $item['quantity'] ?? 1;

                if (!isset($menuCount[$name])) {
                    $menuCount[$name] = 0;
                }

                $menuCount[$name] += $qty;
            }
        }

        arsort($menuCount); // urutkan dari terbanyak

        $menuLabels = array_keys($menuCount);
        $menuTotals = array_values($menuCount);

        // ambil 5 teratas saja
        $menuLabels = array_slice($menuLabels, 0, 5);
        $menuTotals = array_slice($menuTotals, 0, 5);

        return view('admin.report.statistic', compact(
            'labels',
            'totals',
            'menuLabels',
            'menuTotals'
        ));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'table_number' => 'required',
            'cart' => 'required',
        ]);

        $isFromKasir = $request->filled('customer_name');

        // 2. Simpan ke Database
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'table_number'  => $request->table_number,
            'items'         => is_array($request->cart) ? json_encode($request->cart) : $request->cart,
            'total_price'   => $request->total_price,
            'status'        => 'pending',
            'note'          => $request->note,
        ]);

        // 3. JIKA DARI KASIR, GENERATE MIDTRANS SNAP TOKEN
        if ($isFromKasir) {
            // Manual require jika autoloader belum berfungsi
            if (!class_exists('\Midtrans\Config')) {
                require_once base_path('vendor/midtrans/midtrans-php/Midtrans.php');
            }

            // Konfigurasi Midtrans
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => 'ORDER-' . $order->id . '-' . time(),
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                ]
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                return response()->json([
                    'success' => true,
                    'snap_token' => $snapToken,
                    'order_id' => $order->id
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghubungkan ke Midtrans: ' . $e->getMessage()
                ], 500);
            }
        }

        // ================================================================
        // 4. JALUR NINJA KE GOOGLE SHEETS (HANYA CUSTOMER)
        // ================================================================
        try {
            $spreadsheetId = env('POST_SPREADSHEET_ID');
            $client = new \Google\Client();
            $client->setAuthConfig(storage_path('app/google-access.json'));
            $client->addScope(\Google\Service\Sheets::SPREADSHEETS);
            $service = new \Google\Service\Sheets($client);

            $menuDetails = "";
            $cartItemsSheet = is_array($request->cart) ? $request->cart : json_decode($request->cart, true);

            if (!empty($cartItemsSheet)) {
                foreach ($cartItemsSheet as $item) {
                    $jumlah = $item['quantity'] ?? $item['qty'] ?? 1;
                    $namaMenu = $item['name'] ?? 'Menu';
                    $opsi = isset($item['option']) && $item['option'] !== '' ? " (" . $item['option'] . ")" : "";
                    $sugar = isset($item['sugar']) && $item['sugar'] !== '' ? " [" . $item['sugar'] . "]" : "";
                    $menuDetails .= $namaMenu . $opsi . $sugar . " (x" . $jumlah . ")\n";
                }
            }

            $labelIdentitas = "Meja " . $order->table_number;

            $values = [[
                $order->created_at->format('d-m-Y H:i'),
                $labelIdentitas,
                $order->total_price,
                trim($menuDetails),
                $request->note ?? '-',
            ]];

            $body = new \Google\Service\Sheets\ValueRange(['values' => $values]);
            $service->spreadsheets_values->append($spreadsheetId, 'Sheet1', $body, ['valueInputOption' => 'RAW']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Jalur Ninja Error: ' . $e->getMessage());
        }

        // 5. RETURN RESPONSE
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dikirim!',
                'order_id' => $order->id
            ]);
        }

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }

    public function paymentSuccess(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'processing' || $order->status === 'completed') {
            return response()->json(['success' => true, 'print_id' => $order->id]);
        }

        // Hanya ubah status jadi processing. Pemotongan stok dan gsheet dilakukan saat kasir klik Konfirmasi di Dashboard.
        $order->update(['status' => 'processing']);

        // RETURN RESPONSE
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil!',
            'print_id' => $order->id
        ]);
    }


    public function order()
    {
        // Ambil semua menu dari database
        $menus = Menu::with('ingredients')->get();

        // UBAH BAGIAN INI: Jangan '01', ubah jadi 'Takeaway' atau kosongkan
        $table_number = 'Takeaway';

        return view('cashier.pos.order', compact('menus', 'table_number'));
    }

    // Tambahkan fungsi baru
    public function print($id)
    {
        $order = Order::findOrFail($id);
        return view('cashier.pos.print_nota', compact('order'));
    }
}
