<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatistikController extends Controller
{
    public function index()
    {
        $startDate = now()->subDays(29)->startOfDay();
        $endDate = now()->endOfDay();

        // 1. Query Pendapatan (Menggunakan Model Order)
        $salesData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $salesData->map(fn($item) => Carbon::parse($item->date)->format('d M'));
        $totals = $salesData->pluck('total');

        // 2. Query Menu Terpopuler (Menggunakan DB Facade ke tabel order_items)
        // Saya asumsikan nama tabel perantara Anda adalah 'order_items'
        $popularMenus = DB::table('order_items')
            ->select('name', DB::raw('SUM(qty) as total_qty'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('name')
            ->orderByDesc('total_qty')
            ->take(8)
            ->get();

        $menuLabels = $popularMenus->pluck('name');
        $menuTotals = $popularMenus->pluck('total_qty');

        return view('admin.statistic', compact('labels', 'totals', 'menuLabels', 'menuTotals'));
    }
}
