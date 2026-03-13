<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CafeController extends Controller
{
    public function adminDashboard()
    {
        // Ambil pesanan yang belum selesai
        $orders = Order::where('status', '!=', 'completed')->latest()->get();

        // Cek Role User untuk menentukan View
        if (Auth::user()->role === 'admin') {
            return view('admin.dashboard_admin', compact('orders'));
        }

        // Default untuk Kasir
        return view('admin.dashboard_cashier', compact('orders'));
    }

    // Tambahkan fungsi untuk menyelesaikan pesanan agar rute di web.php tidak error
    public function completeOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Pesanan Meja ' . $order->table_number . ' Selesai!');
    }

    public function manageTables()
    {
        // Kita buat array meja sederhana dulu, nanti bisa kamu pindah ke database
        $tables = ['01', '02', '03', '04', '05'];
        return view('admin.tables.index', compact('tables'));
    }

    public function indexPublic($table_number)
    {
        $menus = Menu::all(); // Mengambil data menu dari database

        // Pastikan folder dan nama file sesuai: resources/views/public/menu.blade.php
        return view('public.menu', compact('menus', 'table_number'));
    }
}
