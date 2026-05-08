<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ingredient;

class InventoryController extends Controller
{
    public function index()
    {
        // 1. Ambil data dari database, urutkan berdasarkan nama (A-Z) terlebih dahulu
        $ingredientsFromDB = Ingredient::orderBy('name', 'asc')->get();

        // 2. Buat aturan urutan kustom (Gram di nomor 1, dst)
        $unitOrder = [
            'Gram' => 1,
            'MiliLiter' => 2,
            'Liter' => 3,
            'Botol' => 4,
            'Pcs' => 5,
            'Slice' => 6,
            'Scoop' => 7,
        ];

        // 3. Urutkan ulang data berdasarkan aturan kustom di atas
        $ingredients = $ingredientsFromDB->sortBy(function ($item) use ($unitOrder) {
            // Cari angka urutan berdasarkan satuan. 
            // Jika satuannya tidak ada di daftar, beri nilai 99 (taruh paling bawah)
            return $unitOrder[$item->unit] ?? 99;
        })->values();

        // Hitung statistik untuk ditampilkan di kartu atas
        $totalItems = $ingredients->count();

        // Stok Aman (Stok lebih besar dari batas minimal)
        $safeStock = $ingredients->filter(function ($item) {
            return $item->stock > $item->min_stock;
        })->count();

        // Stok Menipis (Stok lebih dari 0, tapi di bawah/sama dengan batas minimal)
        $lowStock = $ingredients->filter(function ($item) {
            return $item->stock > 0 && $item->stock <= $item->min_stock;
        })->count();

        // Stok Habis (Stok persis 0)
        $outOfStock = $ingredients->filter(function ($item) {
            return $item->stock <= 0;
        })->count();

        return view('admin.inventory.stock', compact('ingredients', 'totalItems', 'safeStock', 'lowStock', 'outOfStock'));
    }
    // 1. Fungsi untuk menampilkan halaman form tambah bahan
    public function add_stock()
    {
        return view('admin.inventory.add_stock');
    }

    // 2. Fungsi untuk memproses dan menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'stock' => 'required|numeric|min:0',
            'min_stock' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        Ingredient::create([
            'name' => $request->name,
            'category' => $request->category,
            'stock' => $request->stock,
            'min_stock' => $request->min_stock,
            'unit' => $request->unit,
        ]);

        // Setelah tersimpan, arahkan kembali ke halaman stok dengan pesan sukses
        return redirect()->route('admin.inventory.stock')->with('success', 'Bahan baku baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'stock' => 'required|numeric|min:0',
            'min_stock' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());

        return redirect()->back()->with('success', 'Bahan baku berhasil diperbarui!');
    }

    // Tambahkan ini di bagian bawah InventoryController
    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->delete();

        return redirect()->back()->with('success', 'Bahan baku berhasil dihapus!');
    }
}
