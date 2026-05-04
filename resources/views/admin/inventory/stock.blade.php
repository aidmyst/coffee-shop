<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">

        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h2 class="text-3xl font-black text-gray-800 uppercase tracking-tight">Inventaris Bahan Baku</h2>
                <p class="text-sm text-gray-500 font-bold">Pantau ketersediaan stok bahan cafe</p>
            </div>

            <button
                class="bg-orange-600 hover:bg-orange-700 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-600/30 active:scale-95 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Bahan
            </button>
        </div>

        {{-- Statistik Cepat --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-orange-500">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Total Jenis Bahan</p>
                <h3 class="text-2xl font-black text-gray-800 mt-1">24 <span
                        class="text-sm text-gray-400 font-normal">Item</span></h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-green-500">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Stok Aman</p>
                <h3 class="text-2xl font-black text-green-600 mt-1">20 <span
                        class="text-sm text-gray-400 font-normal">Item</span></h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-red-500">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Stok Menipis</p>
                <h3 class="text-2xl font-black text-red-600 mt-1">4 <span
                        class="text-sm text-gray-400 font-normal">Item</span></h3>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b">
                        <tr>
                            <th class="px-6 py-4">Nama Bahan</th>
                            <th class="px-6 py-4 text-center">Sisa Stok</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">

                        {{-- Contoh Data 1 (Stok Aman) --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800 text-sm">Biji Kopi Arabica (House Blend)</p>
                                <p class="text-xs text-gray-400 font-medium mt-0.5">Kategori: Biji Kopi</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-black text-gray-700 text-sm">2.500</span>
                                <span class="text-xs text-gray-400 font-medium ml-1">Gram</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider">Aman</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider transition-colors mr-1">Edit</button>
                                <button
                                    class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider transition-colors">Hapus</button>
                            </td>
                        </tr>

                        {{-- Contoh Data 2 (Stok Menipis) --}}
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800 text-sm">Susu Full Cream Fresh</p>
                                <p class="text-xs text-gray-400 font-medium mt-0.5">Kategori: Dairy</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-black text-red-600 text-sm">2</span>
                                <span class="text-xs text-gray-400 font-medium ml-1">Liter</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider animate-pulse border border-red-200">Menipis</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider transition-colors mr-1">Edit</button>
                                <button
                                    class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider transition-colors">Hapus</button>
                            </td>
                        </tr>

                        {{-- Contoh Data 3 (Stok Habis) --}}
                        <tr class="hover:bg-gray-50 transition-colors bg-red-50/30">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800 text-sm">Sirup Vanilla</p>
                                <p class="text-xs text-gray-400 font-medium mt-0.5">Kategori: Sirup & Perasa</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-black text-red-600 text-sm">0</span>
                                <span class="text-xs text-gray-400 font-medium ml-1">Botol</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="bg-gray-800 text-white px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider">Habis</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider transition-colors mr-1">Edit</button>
                                <button
                                    class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider transition-colors">Hapus</button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            {{-- Footer / Pagination Dummy --}}
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
                <span class="text-xs text-gray-500 font-medium">Menampilkan 3 dari 24 bahan baku</span>
                <div class="flex gap-1">
                    <button class="px-3 py-1 border border-gray-200 rounded text-xs font-bold text-gray-400 bg-white"
                        disabled>Prev</button>
                    <button
                        class="px-3 py-1 border border-gray-200 rounded text-xs font-bold text-orange-600 bg-orange-50">1</button>
                    <button
                        class="px-3 py-1 border border-gray-200 rounded text-xs font-bold text-gray-600 bg-white hover:bg-gray-50">2</button>
                    <button
                        class="px-3 py-1 border border-gray-200 rounded text-xs font-bold text-gray-600 bg-white hover:bg-gray-50">Next</button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
