<x-app-layout>
    <div class="py-12 flex justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-3xl shadow-lg border border-gray-100 text-center">
            {{-- Nama Cafe --}}
            <h1 class="text-[24px] font-black text-orange-600 tracking-tight mb-2">Solstice Cafe</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mb-8">Scan untuk Pesan & Lihat Menu
            </p>

            {{-- QR CODE MENGARAH KE LINKTREE --}}
            <div class="flex justify-center mb-8 p-4 bg-white rounded-2xl shadow-inner border border-gray-50">
                {{-- Ganti URL ini dengan URL Linktree Anda --}}
                {!! QrCode::size(200)->color(31, 41, 55)->backgroundColor(255, 255, 255)->generate('https://linktr.ee/Solstice_Cafe') !!}
            </div>

            {{-- Instruksi --}}
            <div class="space-y-2">
                <p class="text-sm font-black text-gray-800 uppercase">Langkah Pesan:</p>
                <p class="text-[11px] text-gray-500 font-medium">1. Scan QR di atas<br>2. Klik tombol 'Pesan Di
                    Sini'<br>3. Pilih nomor meja Anda</p>
            </div>

            {{-- Link Cadangan --}}
            <p class="mt-8 text-[10px] text-gray-300 font-mono break-all uppercase tracking-tighter">
                linktr.ee/Solstice_Cafe
            </p>
        </div>
    </div>
</x-app-layout>
