<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        return $this->create();
    }

    public function create()
    {
        $categories = [
            'Coffee',
            'Non-Coffee',
            'Tea',
            'Juice',
            'Snack',
            'Dessert'
        ];

        $menus = Menu::all();
        return view('admin.menu.create', compact('categories', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price_hot' => 'nullable|numeric',
            'price_ice' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('menu-images', 'public')
            : null;

        Menu::create([
            'name' => $request->name,
            'category' => $request->category,
            'price_hot' => $request->price_hot,
            'price_ice' => $request->price_ice,
            'image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        // 1. Validasi Input disesuaikan dengan price_hot dan price_ice
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required',
            'price_hot' => 'nullable|numeric', // Ubah dari price menjadi price_hot
            'price_ice' => 'nullable|numeric', // Tambahkan price_ice
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $menu = Menu::findOrFail($id);

        // 2. Siapkan data untuk diupdate
        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'price_hot' => $request->price_hot, // Sesuaikan field database
            'price_ice' => $request->price_ice, // Sesuaikan field database
        ];

        // 3. Logika Update Gambar
        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menu-images', 'public');
        }

        // 4. Eksekusi Update
        $menu->update($data);

        // Gunakan back() agar tetap di halaman yang sama jika Anda membuka modal dari index
        return redirect()->back()->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        // Jika menu memiliki gambar, hapus filenya dari storage
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete(); // Hapus data dari database

        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    public function toggleStock($id)
    {
        $menu = \App\Models\Menu::findOrFail($id);

        // Membalikkan status (jika true jadi false, jika false jadi true)
        $menu->update([
            'is_available' => !$menu->is_available
        ]);

        $status = $menu->is_available ? 'Tersedia' : 'Habis';

        return back()->with('success', "Status stok {$menu->name} berhasil diubah menjadi {$status}!");
    }
}
