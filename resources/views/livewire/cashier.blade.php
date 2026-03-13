{{-- resources/views/livewire/casshier.blade.php --}}
<div wire:poll.visible.5s x-data="{
    soundEnabled: localStorage.getItem('audio_active') === 'true',
    enableAudio() {
        // Memancing audio yang ada di layout utama (global-notif-sound)
        const audio = document.getElementById('global-notif-sound');
        if (audio) {
            audio.play().then(() => {
                audio.pause();
                audio.currentTime = 0;
                this.soundEnabled = true;
                localStorage.setItem('audio_active', 'true');
            }).catch(e => {
                console.error('Audio check failed:', e);
                alert('Klik sekali lagi untuk mengaktifkan izin suara browser.');
            });
        }
    }
}" @audio-blocked.window="soundEnabled = false"> {{-- Listener jika audio diblokir di tengah jalan --}}

    <div class="py-6">
        {{-- Statistik Atas --}}
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500">
                <p class="text-sm text-gray-500 font-bold uppercase">Meja Menunggu Pembayaran</p>
                <h3 class="text-3xl font-black text-red-600">{{ $orders->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-500">
                <p class="text-sm text-gray-500 font-bold uppercase">Jam Sekarang</p>
                <h3 class="text-2xl font-bold text-gray-700">{{ now()->format('H:i') }} WIB</h3>
            </div>
        </div>

        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Header --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="py-4 px-6 flex justify-between items-center">
                    <div>
                        <h2 class="font-black text-gray-800 uppercase tracking-wide">Daftar Pesanan Masuk</h2>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Real-time Order Queue
                        </p>
                    </div>

                    <div>
                        {{-- Tombol Aktifkan Suara --}}
                        <button x-show="!soundEnabled" @click="enableAudio()"
                            class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-wider transition-all animate-bounce shadow-lg">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.983 5.983 0 01-1.414 4.243 1 1 0 11-1.415-1.415A3.984 3.984 0 0013 10a3.984 3.984 0 00-1.414-2.828a1 1 0 010-1.415z" />
                            </svg>
                            Klik Aktifkan Suara Notifikasi
                        </button>

                        {{-- Status Aktif --}}
                        <div x-show="soundEnabled" x-cloak class="flex flex-col items-end">
                            <span
                                class="text-[10px] text-green-500 font-black uppercase animate-pulse flex items-center gap-1">
                                ● Sistem Live Aktif
                            </span>
                            <button @click="localStorage.removeItem('audio_active'); location.reload();"
                                class="text-[8px] text-gray-400 hover:text-red-500 uppercase tracking-tighter mt-1">
                                Reset Audio
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Pesanan --}}
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead
                            class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b">
                            <tr>
                                <th class="px-6 py-4 text-center">Meja</th>
                                <th class="px-6 py-4 text-center">Waktu</th>
                                <th class="px-6 py-4 text-center">Rincian Menu</th>
                                <th class="px-6 py-4 text-center">Catatan</th>
                                <th class="px-6 py-4 text-center">Tagihan</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($orders as $order)
                                <tr wire:key="order-{{ $order->id }}" class="hover:bg-gray-50 transition-colors">
                                    {{-- Kolom Meja --}}
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="bg-orange-600 text-white px-3 py-1.5 rounded-lg font-black text-xs shadow-sm">
                                            {{ $order->table_number }}
                                        </span>
                                    </td>

                                    {{-- Kolom Waktu --}}
                                    <td class="px-6 py-4 text-center">
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
                                                    @if (isset($item->option) || isset($item->sugar))
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            @if (isset($item->option))
                                                                {{ $item->option }}
                                                            @endif
                                                            @if (isset($item->option) && isset($item->sugar))
                                                                •
                                                            @endif
                                                            @if (isset($item->sugar))
                                                                {{ $item->sugar }}
                                                            @endif
                                                        </div>
                                                    @endif

                                                </div>
                                            @endforeach
                                        </div>
                                    </td>

                                    {{-- Kolom Catatan --}}
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center text-center">
                                            @if ($order->note)
                                                <p
                                                    class="text-[14px] text-gray-600 italic leading-relaxed p-2 rounded-lg bg-yellow-50/50 border border-yellow-100">
                                                    "{{ $order->note }}"
                                                </p>
                                            @else
                                                <span class="text-gray-300 text-[14px] italic">Tidak ada catatan</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Kolom Harga --}}
                                    <td class="px-6 py-4 text-center font-black text-gray-800 text-sm">
                                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="px-6 py-4 text-center">
                                        <button wire:click="completeOrder({{ $order->id }})"
                                            wire:loading.attr="disabled"
                                            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 disabled:opacity-50">
                                            <span wire:loading.remove
                                                wire:target="completeOrder({{ $order->id }})">Konfirmasi ➜</span>
                                            <span wire:loading
                                                wire:target="completeOrder({{ $order->id }})">Memproses...</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-20 text-center opacity-30">
                                        <p class="font-black uppercase tracking-widest text-xs text-gray-400">Belum ada
                                            pesanan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
