<x-app-layout>
    {{-- Tambahkan state 'showEditModal' dan 'editingMenu' pada x-data --}}
    <div class="py-6" x-data="{
        activeFilter: 'Semua',
        search: '',
        showEditModal: false,
        editingMenu: { id: '', name: '', price_hot: '', price_ice: '', category: '', image: '' }
    }">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 transition-all">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" {{-- 3000ms = 3 detik --}}
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold rounded shadow-sm flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-10 gap-6 mb-6 sticky top-6 z-50">

                {{-- FILTER (sejajar dengan 3 card menu) --}}
                <div class="lg:col-span-7">
                    <div class="bg-white p-2 rounded-xl shadow-sm border flex flex-wrap gap-2 items-center">
                        @php
                            $filters = ['Semua', 'Coffee', 'Non-Coffee', 'Tea', 'Juice', 'Snack', 'Dessert'];
                        @endphp

                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-2">

                            @foreach ($filters as $f)
                                <button @click="activeFilter = '{{ $f }}'"
                                    :class="activeFilter === '{{ $f }}'
                                        ?
                                        'bg-orange-600 text-white shadow-md' :
                                        'text-gray-500 hover:bg-gray-100'"
                                    class="w-full px-3 py-2 rounded-xl text-xs font-black uppercase tracking-widest transition flex items-center justify-center whitespace-nowrap">
                                    {{ $f }}
                                </button>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- SEARCH (di atas form tambah menu) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white p-2 rounded-xl shadow-sm border flex items-center gap-2">

                        <svg class="w-4 h-4 text-gray-400 ml-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z">
                            </path>
                        </svg>

                        <input type="text" x-model="search" placeholder="Cari menu..."
                            class="flex-1 px-3 py-2 text-xs font-black uppercase tracking-widest bg-transparent outline-none border-none focus:ring-0 text-gray-600 placeholder-gray-400">
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-10 gap-6">

                {{-- KIRI: Daftar Menu (70%) --}}
                <div class="lg:col-span-7 flex flex-col gap-8">
                    @foreach ($categories as $cat)
                        <div x-show="
                            (activeFilter === 'Semua' || activeFilter === '{{ $cat }}') &&
                            (search === '' || 
                            {{ $menus->where('category', $cat)->pluck('name')->map(fn($n) => strtolower($n))->values()->toJson() }}
                            .some(name => name.includes(search.toLowerCase()))
                            )
                            "
                            x-transition x-cloak class="bg-white p-4 shadow sm:rounded-lg border">

                            <div class="flex justify-between items-center border-b pb-2 mb-4">
                                <h3 class="text-md font-black text-gray-800 uppercase tracking-widest">
                                    <span class="text-orange-600 mr-2">|</span>{{ $cat }}
                                </h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @forelse ($menus->where('category', $cat) as $menu)
                                    {{-- Ganti bagian ini di dalam loop @forelse Daftar Menu --}}
                                    <div x-show="search === '' || '{{ strtolower($menu->name) }}'.includes(search.toLowerCase())"
                                        class="rounded-xl shadow-sm border border-gray-100 overflow-hidden group transition-all relative flex flex-col h-full 
                                        {{ !($menu->is_available ?? true) ? 'bg-gray-100 opacity-60 grayscale' : 'bg-white hover:shadow-md' }}">

                                        {{-- Bagian Gambar --}}
                                        <div
                                            class="aspect-square w-full bg-gray-100 overflow-hidden relative flex-shrink-0">
                                            @if ($menu->image)
                                                <img src="{{ asset('storage/' . $menu->image) }}"
                                                    class="w-full h-full object-cover">
                                            @endif

                                            {{-- (Opsional) Tambahkan Label overlay "Stok Habis" di gambar admin agar lebih jelas --}}
                                            @if (!($menu->is_available ?? true))
                                                <div
                                                    class="absolute inset-0 bg-black/20 flex items-center justify-center backdrop-blur-[1px]">
                                                    <span
                                                        class="bg-red-600 text-white font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-widest shadow-xl">
                                                        Stok Habis
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Bagian Konten Teks --}}
                                        <div class="p-3 flex flex-col flex-1">
                                            <h4 class="font-bold text-gray-900 text-sm truncate mb-1">
                                                {{ $menu->name }}
                                            </h4>

                                            {{-- AREA HARGA --}}
                                            <div class="flex flex-col gap-1 mt-2 pt-2 border-t border-gray-50">
                                                @if ($menu->category === 'Snack' || $menu->category === 'Dessert')
                                                    <div class="flex justify-between items-center">
                                                        <span
                                                            class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Harga</span>
                                                        <p class="text-sm font-black text-gray-800">
                                                            Rp{{ number_format($menu->price_hot) }}</p>
                                                    </div>
                                                @else
                                                    @if ($menu->price_hot)
                                                        <div class="flex justify-between items-center">
                                                            <span
                                                                class="text-[10px] font-bold uppercase tracking-tighter {{ ($menu->category === 'Non-Coffee' && $menu->name === 'Mineral Water') || $menu->category === 'Juice' ? 'text-gray-400' : 'text-orange-600' }}">
                                                                {{ ($menu->category === 'Non-Coffee' && $menu->name === 'Mineral Water') || $menu->category === 'Juice' ? 'Normal' : 'Hot' }}
                                                            </span>
                                                            <p class="text-sm font-black text-gray-800">
                                                                Rp{{ number_format($menu->price_hot) }}</p>
                                                        </div>
                                                    @endif

                                                    @if ($menu->price_ice)
                                                        <div class="flex justify-between items-center">
                                                            <span
                                                                class="text-[10px] font-bold text-blue-500 uppercase tracking-tighter">Ice</span>
                                                            <p class="text-sm font-black text-gray-800">
                                                                Rp{{ number_format($menu->price_ice) }}</p>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                            {{-- AREA TOMBOL --}}
                                            <div
                                                class="flex justify-end items-center mt-auto pt-4 border-t border-gray-50">
                                                <div class="flex items-center gap-1.5">

                                                    {{-- TOMBOL STOK HABIS / TERSEDIA --}}
                                                    <form action="{{ route('admin.menu.toggle-stock', $menu->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        {{-- Hapus style grayscale khusus untuk tombol ini agar warna tombol tetap terlihat jelas --}}
                                                        <button type="submit" title="Ubah Status Stok"
                                                            class="px-2 py-1.5 rounded-lg transition shadow-sm text-[10px] font-black uppercase tracking-widest flex items-center justify-center min-w-[70px]
                        {{ $menu->is_available ?? true ? 'bg-green-50 text-green-600 hover:bg-green-600 hover:text-white' : 'bg-red-50 text-red-600 hover:bg-red-600 hover:text-white filter-none' }}"
                                                            style="filter: grayscale(0%); opacity: 1;">
                                                            {{ $menu->is_available ?? true ? 'Tersedia' : 'Habis' }}
                                                        </button>
                                                    </form>

                                                    {{-- TOMBOL EDIT --}}
                                                    <button
                                                        @click="editingMenu={ id: '{{ $menu->id }}' , name: '{{ $menu->name }}' , price_hot: '{{ $menu->price_hot }}' , price_ice: '{{ $menu->price_ice }}' , category: '{{ $menu->category }}' }; showEditModal=true"
                                                        class="p-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm"
                                                        style="filter: grayscale(0%); opacity: 1;">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                            </path>
                                                        </svg>
                                                    </button>

                                                    {{-- TOMBOL HAPUS --}}
                                                    <form action="{{ route('admin.menu.destroy', $menu->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Hapus {{ $menu->name }}?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit"
                                                            class="p-1.5 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm"
                                                            style="filter: grayscale(0%); opacity: 1;">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="lg:col-span-3 text-center py-6 text-gray-400 text-xs italic">Belum ada
                                        menu.</div>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- KANAN: Form Tambah Menu (Sticky) --}}
                <div class="lg:col-span-3">
                    {{-- Tambahkan x-data="{ category: 'Coffee' }" di sini --}}
                    <div class="bg-white p-6 shadow sm:rounded-lg sticky top-24 border" x-data="{ category: 'Coffee', menuName: '' }">
                        <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">Tambah Menu Baru</h3>
                        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700">Nama Menu</label>
                                    <input type="text" name="name" x-model="menuName"
                                        class="w-full border-gray-300 rounded-lg mt-1 text-sm focus:ring-orange-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700">Kategori</label>
                                    {{-- Tambahkan x-model="category" di sini --}}
                                    <select name="category" x-model="category"
                                        class="w-full border-gray-300 rounded-lg mt-1 text-sm focus:ring-orange-500">
                                        <option value="Coffee">Coffee</option>
                                        <option value="Non-Coffee">Non-Coffee</option>
                                        <option value="Tea">Tea</option>
                                        <option value="Juice">Juice</option>
                                        <option value="Snack">Snack</option>
                                        <option value="Dessert">Dessert</option>
                                    </select>
                                </div>

                                {{-- INPUT KHUSUS SNACK (Hanya muncul jika kategori Snack) --}}
                                <div x-show="category === 'Snack' || category === 'Dessert'" x-transition
                                    x-data="{ rawPrice: '', formatRupiah(val) { return val ? val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '' }, parseRaw(val) { return val.replace(/[^0-9]/g, '') } }">
                                    <label class="block text-sm font-bold text-gray-700">Harga (Rp)</label>
                                    <input type="text" x-model="rawPrice"
                                        @input="rawPrice = formatRupiah(parseRaw($event.target.value))"
                                        class="w-full border-gray-300 rounded-lg mt-1 text-sm focus:ring-orange-500"
                                        placeholder="Masukkan harga">
                                    {{-- Snack akan disimpan ke price_hot agar logika controller tetap jalan atau disesuaikan --}}
                                    <input type="hidden" name="price_hot" :value="parseRaw(rawPrice)">
                                </div>

                                {{-- INPUT HOT & ICE (Hanya muncul jika BUKAN Snack) --}}
                                <template x-if="category !== 'Snack' && category !== 'Dessert'">
                                    <div class="space-y-4">
                                        {{-- Input Harga Hot --}}
                                        <div x-data="{ rawHot: '', formatRupiah(val) { return val ? val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '' }, parseRaw(val) { return val.replace(/[^0-9]/g, '') } }">
                                            <label class="block text-sm font-bold text-gray-700"
                                                x-text="(category === 'Non-Coffee' && menuName.toLowerCase() === 'mineral water') || category === 'Juice'
                                                ? 'Harga Normal (Rp)'
                                                : 'Harga Hot (Rp)'">
                                            </label>
                                            <input type="text" x-model="rawHot"
                                                @input="rawHot = formatRupiah(parseRaw($event.target.value))"
                                                class="w-full border-gray-300 rounded-lg mt-1 text-sm focus:ring-orange-500"
                                                placeholder="Kosongkan jika tidak ada">
                                            <input type="hidden" name="price_hot" :value="parseRaw(rawHot)">
                                        </div>

                                        {{-- Input Harga Ice --}}
                                        <div x-data="{ rawIce: '', formatRupiah(val) { return val ? val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '' }, parseRaw(val) { return val.replace(/[^0-9]/g, '') } }">
                                            <label class="block text-sm font-bold text-gray-700">Harga Ice (Rp)</label>
                                            <input type="text" x-model="rawIce"
                                                @input="rawIce = formatRupiah(parseRaw($event.target.value))"
                                                class="w-full border-gray-300 rounded-lg mt-1 text-sm focus:ring-orange-500"
                                                placeholder="Kosongkan jika tidak ada">
                                            <input type="hidden" name="price_ice" :value="parseRaw(rawIce)">
                                        </div>
                                    </div>
                                </template>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700">Foto Produk</label>
                                    <input type="file" name="image"
                                        class="w-full text-xs mt-1 border p-1 rounded-lg">
                                </div>

                                <button type="submit"
                                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-black py-3 rounded-lg transition shadow-md uppercase tracking-widest text-xs">
                                    Simpan Menu
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- MODAL EDIT MENU (Alpine.js) --}}
        {{-- ========================================== --}}
        <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>

            {{-- Overlay --}}
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity" @click="showEditModal = false">
            </div>

            {{-- Modal Content --}}
            <div class="flex items-center justify-center min-h-screen p-4">
                <div x-show="showEditModal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden relative z-10" @click.stop>

                    <div class="p-6">

                        {{-- HEADER --}}
                        <div class="flex justify-between items-center mb-6 border-b pb-4">
                            <h3 class="text-xl font-black text-gray-800 uppercase tracking-tighter">
                                Edit Menu
                            </h3>

                            <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        {{-- FORM UPDATE --}}
                        <form :action="'/admin/menu/' + editingMenu.id" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                {{-- NAMA MENU --}}
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">
                                        Nama Menu
                                    </label>
                                    <input type="text" name="name" x-model="editingMenu.name"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500 shadow-sm">
                                </div>

                                {{-- KATEGORI --}}
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">
                                        Kategori
                                    </label>
                                    <select name="category" x-model="editingMenu.category"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500 shadow-sm">
                                        <option value="Coffee">Coffee</option>
                                        <option value="Non-Coffee">Non-Coffee</option>
                                        <option value="Tea">Tea</option>
                                        <option value="Juice">Juice</option>
                                        <option value="Snack">Snack</option>
                                        <option value="Dessert">Dessert</option>
                                    </select>
                                </div>

                                {{-- HARGA NORMAL (Mineral / Snack) --}}
                                <div x-show="
                                editingMenu.category === 'Snack' ||
                                editingMenu.category === 'Dessert' ||
                                editingMenu.category === 'Juice' ||
                                (editingMenu.category === 'Non-Coffee' && editingMenu.name === 'Mineral Water')
                                "
                                    x-data="{
                                        formatRupiah(val) {
                                                return val ? val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : ''
                                            },
                                            parseRaw(val) {
                                                return val.toString().replace(/[^0-9]/g, '')
                                            }
                                    }">

                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">
                                        Harga Normal (Rp)
                                    </label>

                                    <input type="text" :value="formatRupiah(editingMenu.price_hot)"
                                        @input="editingMenu.price_hot = parseRaw($event.target.value)"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500 shadow-sm"
                                        placeholder="Masukkan harga normal">

                                    <input type="hidden" name="price_hot" :value="editingMenu.price_hot">

                                </div>

                                {{-- HARGA HOT (selain mineral & snack) --}}
                                <div x-show="
                                editingMenu.category !== 'Snack' &&
                                editingMenu.category !== 'Dessert' &&
                                editingMenu.category !== 'Juice' &&
                                !(editingMenu.category === 'Non-Coffee' && editingMenu.name === 'Mineral Water')
                                "
                                    x-data="{
                                        formatRupiah(val) {
                                                return val ? val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : ''
                                            },
                                            parseRaw(val) {
                                                return val.toString().replace(/[^0-9]/g, '')
                                            }
                                    }">

                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">
                                        Harga Hot (Rp)
                                    </label>

                                    <input type="text" :value="formatRupiah(editingMenu.price_hot)"
                                        @input="editingMenu.price_hot = parseRaw($event.target.value)"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500 shadow-sm"
                                        placeholder="Kosongkan jika tidak ada">

                                    <input type="hidden" name="price_hot" :value="editingMenu.price_hot">

                                </div>

                                {{-- HARGA ICE (tidak ada untuk snack) --}}
                                <div x-show="editingMenu.category !== 'Snack' && editingMenu.category !== 'Dessert'"
                                    x-data="{
                                        formatRupiah(val) {
                                                return val ? val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : ''
                                            },
                                            parseRaw(val) {
                                                return val.toString().replace(/[^0-9]/g, '')
                                            }
                                    }">

                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">
                                        Harga Ice (Rp)
                                    </label>

                                    <input type="text" :value="formatRupiah(editingMenu.price_ice)"
                                        @input="editingMenu.price_ice = parseRaw($event.target.value)"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500 shadow-sm"
                                        placeholder="Kosongkan jika tidak ada">

                                    <input type="hidden" name="price_ice" :value="editingMenu.price_ice">

                                </div>

                                {{-- FOTO --}}
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">
                                        Ganti Foto (Opsional)
                                    </label>

                                    <input type="file" name="image"
                                        class="w-full text-xs mt-1 border p-2 rounded-xl">
                                </div>

                                {{-- BUTTON --}}
                                <div class="flex gap-3 pt-4">

                                    <button type="button" @click="showEditModal = false"
                                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition uppercase tracking-widest text-xs">
                                        Batal
                                    </button>

                                    <button type="submit"
                                        class="flex-1 bg-orange-600 hover:bg-orange-700 text-white font-black py-3 rounded-xl transition shadow-lg uppercase tracking-widest text-xs">
                                        Update Menu
                                    </button>

                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
