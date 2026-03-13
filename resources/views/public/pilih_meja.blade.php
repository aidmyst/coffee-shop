<x-public-layout>
    <div class="min-h-screen bg-gray-50 flex flex-col items-center justify-center p-6">
        <div class="w-full max-w-sm">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-black text-orange-600 uppercase italic tracking-tighter">Solstice Cafe</h2>
                <div class="h-1 w-12 bg-orange-500 mx-auto mt-2 rounded-full"></div>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-4">Silakan Pilih Nomor Meja</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @foreach (range(1, 20) as $t)
                    {{-- Sesuaikan jumlah meja Anda --}}
                    <a href="/menu/{{ str_pad($t, 2, '0', STR_PAD_LEFT) }}"
                        class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 text-center transition-all active:scale-90 hover:border-orange-500 group">
                        <span
                            class="block text-[10px] font-black text-gray-400 group-hover:text-orange-400 uppercase tracking-widest mb-1">Meja</span>
                        <span
                            class="text-2xl font-black text-gray-800 group-hover:text-orange-600">{{ str_pad($t, 2, '0', STR_PAD_LEFT) }}</span>
                    </a>
                @endforeach
            </div>

            <p class="text-center text-[10px] text-gray-300 mt-12 font-bold uppercase tracking-widest italic">Digital
                Menu System v1.0</p>
        </div>
    </div>
</x-public-layout>
