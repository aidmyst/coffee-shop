<x-app-layout>
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 py-8">

        {{-- HEADER TAMBAH BAHAN BAKU --}}
        <div class="flex items-center gap-5 mb-8">

            {{-- Tombol Kembali (Back) --}}
            <a href="{{ route('admin.inventory.stock') }}"
                class="group flex items-center justify-center w-12 h-12 bg-white rounded-2xl shadow-sm border border-gray-100 hover:bg-orange-500 hover:border-orange-500 hover:shadow-orange-500/30 transition-all duration-300 ease-out shrink-0">

                {{-- Ikon Panah --}}
                <svg class="w-6 h-6 text-orange-500 group-hover:text-white transition-colors duration-300 ease-out"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                </svg>
            </a>

            {{-- Judul dan Deskripsi --}}
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                    <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight flex items-center gap-2">
                        {{-- Ikon Plus/Box --}}
                        <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Tambah Bahan Baku
                    </h2>
                </div>

                <p class="text-sm text-gray-500 font-bold mt-2 ml-1">
                    Masukkan detail item ke dalam inventaris cafe
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6 sm:p-8">
            <form action="{{ route('admin.inventory.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Bahan --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Nama Bahan
                            Baku</label>
                        <input type="text" name="name" required placeholder="Contoh: Biji Kopi Espresso"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-3 font-medium transition-all">
                    </div>

                    {{-- Kategori --}}
                    <div class="col-span-2 md:col-span-1">
                        <label
                            class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Kategori</label>
                        <select name="category" required
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-3 font-medium transition-all">
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="Kopi & Teh">Kopi & Teh (Biji Kopi, Daun Teh)</option>
                            <option value="Dairy & Cairan">Dairy & Cairan (Susu, Air, Es Krim)</option>
                            <option value="Sirup & Pemanis">Sirup & Pemanis (Gula, Madu, Sirup)</option>
                            <option value="Powder">Powder (Matcha, Red Velvet, Taro)</option>
                            <option value="Buah Segar">Buah Segar (Lemon, Strawberry, dll)</option>
                            <option value="Frozen Food">Frozen Food (Nugget, Kentang, dll)</option>
                            <option value="Pastry & Dessert">Pastry & Dessert (Cake, Roti)</option>
                        </select>
                    </div>

                    {{-- Satuan --}}
                    <div class="col-span-2 md:col-span-2">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Satuan
                            Pengukuran</label>
                        <select name="unit" required
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-3 font-medium transition-all">
                            <option value="" disabled selected>Pilih Satuan...</option>
                            <option value="Gram">Gram (gr)</option>
                            <option value="MiliLiter">MiliLiter (ml)</option>
                            <option value="Liter">Liter (L)</option>
                            <option value="Botol">Botol</option>
                            <option value="Pcs">Pcs / Buah</option>
                            <option value="Slice">Slice / Potong</option>
                            <option value="Scoop">Scoop</option>
                        </select>
                        <p class="text-[10px] text-gray-400 font-bold mt-1.5">*Gunakan satuan terkecil agar pemotongan
                            resep akurat (Misal: 1 Liter susu diinput sebagai 1000 MiliLiter).</p>
                    </div>

                    {{-- Stok Awal --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Stok Saat
                            Ini</label>
                        <input type="number" name="stock" step="0.01" min="0" required placeholder="0"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-3 font-medium transition-all">
                    </div>

                    {{-- Batas Stok Menipis --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-xs font-black text-gray-500 uppercase tracking-widest mb-2">Batas
                            Peringatan Menipis</label>
                        <input type="number" name="min_stock" step="0.01" min="0" required
                            placeholder="Contoh: 100"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block p-3 font-medium transition-all">
                        <p class="text-[10px] text-gray-400 font-bold mt-1.5">*Sistem akan memberi warna peringatan
                            merah jika stok menyentuh angka ini.</p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit"
                        class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-600/30 active:scale-95">
                        Simpan Bahan Baku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
