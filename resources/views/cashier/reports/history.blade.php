<x-app-layout>
    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 transition-all">
            {{-- Header Halaman --}}
            {{-- Header Riwayat (Gaya Dashboard Admin) --}}
            <div class="max-w-full mx-auto mb-6">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6 flex flex-wrap justify-between items-center gap-4">

                    {{-- Bagian Kiri: Judul --}}
                    <div>
                        <h3 class="font-black text-lg text-gray-800 uppercase tracking-tighter">
                            Riwayat Transaksi
                        </h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                            Daftar pesanan yang sudah selesai dibayar
                        </p>
                    </div>

                    {{-- Bagian Kanan: Total Selesai + Total Pendapatan --}}
                    <div class="flex items-center gap-4">
                        {{-- Total Selesai --}}
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <p class="text-2xl font-black text-blue-600 leading-none">
                                {{ $orders->where('status', 'completed')->count() }}
                            </p>
                            <div class="flex flex-col">
                                <p class="text-[12px] text-gray-400 font-black uppercase tracking-widest leading-tight">
                                    Total Selesai
                                </p>
                                <p class="text-[12px] font-bold text-blue-700 uppercase tracking-tighter">
                                    Pesanan
                                </p>
                            </div>
                        </div>

                        {{-- Total Pendapatan --}}
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <p class="text-2xl font-black text-green-600 leading-none">
                                Rp
                                {{ number_format($orders->where('status', 'completed')->sum('total_price'), 0, ',', '.') }}
                            </p>
                            <div class="flex flex-col">
                                <p class="text-[12px] text-gray-400 font-black uppercase tracking-widest leading-tight">
                                    Total Pendapatan
                                </p>
                                <p class="text-[12px] font-bold text-green-700 uppercase tracking-tighter">
                                    Dari Pesanan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Riwayat --}}
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead
                            class="bg-gray-50 text-gray-400 text-[10px] uppercase font-black tracking-widest border-b">
                            <tr>
                                <th class="px-6 py-4 text-center">Pelanggan / Meja</th>
                                <th class="px-6 py-4 text-center">Waktu</th>
                                <th class="px-6 py-4 text-center">Rincian Menu & Qty</th>
                                <th class="px-6 py-4 text-center">Catatan</th>
                                <th class="px-6 py-4 text-center">Total Bayar</th>
                                <th class="px-6 py-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($orders->where('status', 'completed')->sortByDesc('updated_at') as $order)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    {{-- Kolom Pelanggan / Meja --}}
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center gap-1.5 text-center">

                                            {{-- Jika ada Nama Kustomer --}}
                                            @if (!empty($order->customer_name))
                                                <span
                                                    class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg font-black text-[10px] shadow-sm uppercase tracking-widest">
                                                    {{ $order->customer_name }}
                                                </span>
                                            @endif

                                            {{-- Logika Penampilan Meja / Tipe Pesanan --}}
                                            @if (!empty($order->table_number))
                                                @php
                                                    $tableLower = strtolower($order->table_number);
                                                    // Daftar kata yang tidak boleh pakai imbuhan "Meja"
                                                    $isSpecial = in_array($tableLower, [
                                                        'takeaway',
                                                        'dine in',
                                                        'kasir',
                                                        'pos',
                                                    ]);
                                                @endphp

                                                @if ($isSpecial)
                                                    {{-- Badge Abu-abu untuk Takeaway / Dine In (Tanpa kata Meja) --}}
                                                    <span
                                                        class="bg-gray-100 text-gray-500 px-3 py-1 rounded-lg font-black text-[10px] shadow-sm uppercase tracking-widest">
                                                        {{ $order->table_number }}
                                                    </span>
                                                @else
                                                    {{-- Badge Orange untuk Meja Asli (01, 02, dst) --}}
                                                    <span
                                                        class="bg-orange-600 text-white px-3 py-1 rounded-lg font-black text-[10px] shadow-sm uppercase tracking-widest">
                                                        Meja {{ $order->table_number }}
                                                    </span>
                                                @endif
                                            @endif

                                        </div>
                                    </td>

                                    {{-- Kolom Waktu --}}
                                    <td class="px-6 py-4 text-center text-center">
                                        <p class="text-[14px] font-bold text-gray-700">
                                            {{ $order->created_at->format('H:i') }}</p>
                                        <p class="text-[14px] text-gray-400 font-medium uppercase">WIB</p>
                                    </td>

                                    {{-- Kolom Rincian --}}
                                    <td class="px-6 py-4">
                                        <div class="space-y-4 px-8">
                                            @foreach (json_decode($order->items) ?? [] as $item)
                                                <div
                                                    class="flex flex-col border-b border-gray-100 last:border-none pb-2">

                                                    {{-- Nama dan Qty --}}
                                                    <div class="flex justify-between items-center w-full">
                                                        <span class="font-bold text-gray-800 text-sm tracking-tight">
                                                            {{ $item->name }}
                                                        </span>

                                                        <span class="text-gray-500 font-medium text-xs">
                                                            x{{ $item->qty }}
                                                        </span>
                                                    </div>

                                                    {{-- Detail opsi --}}
                                                    @if (!empty($item->option) || !empty($item->sugar))
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            {{-- Tampilkan Option jika tidak kosong --}}
                                                            @if (!empty($item->option))
                                                                {{ $item->option }}
                                                            @endif

                                                            {{-- Simbol Titik hanya jika Option DAN Sugar sama-sama punya isi teks --}}
                                                            @if (!empty($item->option) && !empty($item->sugar))
                                                                •
                                                            @endif

                                                            {{-- Tampilkan Sugar jika tidak kosong --}}
                                                            @if (!empty($item->sugar))
                                                                {{ $item->sugar }}
                                                            @endif
                                                        </div>
                                                    @endif

                                                </div>
                                            @endforeach
                                        </div>
                                    </td>

                                    {{-- Kolom Catatan Kustomer --}}
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center text-center">
                                            @if ($order->note)
                                                <div class="max-w-[150px]">
                                                    <p
                                                        class="text-[14px] text-gray-600 italic leading-relaxed p-2 rounded-lg bg-yellow-50/50 border border-yellow-100">
                                                        "{{ $order->note }}"
                                                    </p>
                                                </div>
                                            @else
                                                <span class="text-gray-300 text-[14px] italic">Tidak ada catatan</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Kolom Harga --}}
                                    <td class="px-6 py-4 text-center font-black text-gray-800 text-sm">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>

                                    {{-- Kolom Status --}}
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <span
                                                class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-green-200">
                                                Paid
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center text-gray-400">
                                        <div class="flex flex-col items-center opacity-30">
                                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                </path>
                                            </svg>
                                            <p class="font-black uppercase tracking-widest text-xs">Belum ada aktivitas
                                                pesanan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
