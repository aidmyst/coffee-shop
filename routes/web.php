<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\StatistikController;
use App\Models\Menu;
use App\Models\Order;
use App\Http\Controllers\Admin\InventoryController;

// --- HALAMAN UTAMA & PUBLIC ---
Route::get('/', function () {
    // Menggunakan try-catch agar jika database belum siap, aplikasi tidak langsung crash
    try {
        $menus = Menu::all();
    } catch (\Exception $e) {
        $menus = collect();
    }
    $table_number = '01';
    return view('public.menu', compact('menus', 'table_number'));
});

Route::get('/pilih-meja', function () {
    $tables = array_map(fn($n) => str_pad($n, 2, '0', STR_PAD_LEFT), range(1, 10));
    return view('public.pilih_meja', compact('tables'));
})->name('pilih.meja');

Route::get('/menu/{table_number}', [CafeController::class, 'indexPublic'])->name('menu.public');

// Rute Submit Order (Pastikan OrderController@submit sudah siap)
Route::post('/order/submit', [OrderController::class, 'store'])->name('order.submit');

// --- AREA LOGIN (KASIR & ADMIN) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Kasir
    Route::get('/dashboard', [OrderController::class, 'adminDashboard'])->name('dashboard');
    Route::post('/orders/{id}/complete', [OrderController::class, 'complete'])->name('orders.complete');
    Route::get('/cashier/reports/history', [OrderController::class, 'history'])->name('cashier.reports.history');
    Route::get('/cashier/pos/order', [OrderController::class, 'order'])->name('cashier.pos.order');
    Route::get('/order/print/{id}', [OrderController::class, 'print'])->name('order.print');

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Statistik
    Route::get('/admin/statistic', [StatistikController::class, 'index'])->name('admin.statistic');
    Route::get('/admin/export-daily', [OrderController::class, 'exportDaily'])->name('admin.export.daily');
    Route::get('/admin/export-all', [OrderController::class, 'exportAll'])->name('admin.export.all');

    // --- AREA KHUSUS ADMIN (Owner) ---
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/tables', function () {
            $tables = array_map(fn($n) => str_pad($n, 2, '0', STR_PAD_LEFT), range(1, 20));
            return view('admin.tables.kode_qr', compact('tables'));
        })->name('admin.tables.kode_qr');

        Route::get('/admin/report/statistic', [OrderController::class, 'statistics'])->name('admin.report.statistic');

        // Resource Menu
        Route::resource('admin/menu', MenuController::class)->names('admin.menu');

        // Stok
        Route::patch('/admin/menu/{menu}/toggle-stock', [App\Http\Controllers\Admin\MenuController::class, 'toggleStock'])->name('admin.menu.toggle-stock');

        Route::get('/admin/inventory/stock', [InventoryController::class, 'index'])->name('admin.inventory.stock');
        Route::get('/admin/inventory/add_stock', [App\Http\Controllers\Admin\InventoryController::class, 'add_stock'])->name('admin.inventory.add_stock');
        Route::post('/admin/inventory/store', [App\Http\Controllers\Admin\InventoryController::class, 'store'])->name('admin.inventory.store');
        Route::put('/admin/inventory/{id}', [App\Http\Controllers\Admin\InventoryController::class, 'update'])->name('admin.inventory.update');
        Route::delete('/admin/inventory/{id}', [App\Http\Controllers\Admin\InventoryController::class, 'destroy'])->name('admin.inventory.destroy');

        Route::get('/admin/menu/{menu}/recipe', [App\Http\Controllers\Admin\MenuController::class, 'recipe'])->name('admin.menu.recipe');
        Route::post('/admin/menu/{menu}/recipe', [App\Http\Controllers\Admin\MenuController::class, 'storeRecipe'])->name('admin.menu.recipe.store');
    });
});

Route::get('/api/check-orders', function () {
    $lastOrder = Order::where('status', 'pending')
        ->latest()
        ->first();
    return response()->json([
        'last_id' => $lastOrder?->id
    ]);
});

// realtime badge pesanan
Route::get('/api/pending-orders-count', function () {
    return response()->json([
        'count' => Order::where('status', 'pending')->count()
    ]);
})->middleware('auth');

require __DIR__ . '/auth.php';
