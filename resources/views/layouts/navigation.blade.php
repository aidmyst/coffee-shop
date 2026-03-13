<aside
    class="bg-white shadow-md h-screen transition-all duration-700 ease-in-out hidden md:flex flex-col border-r border-gray-100 sticky top-0 overflow-hidden"
    :class="sidebarOpen ? 'w-64' : 'w-20'">

    <div class="relative flex flex-col items-center justify-center transition-all duration-700 ease-in-out overflow-hidden"
        :class="sidebarOpen ? 'h-32 p-6' : 'h-20 p-2'">

        <div class="absolute top-6 z-20 transition-all duration-700 ease-in-out"
            :class="sidebarOpen ? 'left-1/2 translate-x-16' : 'left-1/2 -translate-x-1/2'">
            <button @click="toggleSidebar()"
                class="p-2 rounded-lg hover:bg-orange-50 text-orange-600 transition-all duration-300 focus:outline-none active:scale-90">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>

        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-700 delay-200"
            x-transition:enter-start="opacity-0 scale-90 -translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90" class="flex flex-col items-center justify-center w-full mt-4">

            <a href="{{ route('dashboard') }}" class="block">
                <img src="{{ asset('storage/images/Solstice.png') }}" alt="Solstice Cafe Logo"
                    class="h-20 w-20 rounded-full object-cover border-2 border-white ring-2 ring-orange-100 shadow-sm transition-transform hover:scale-105">
            </a>

            <span class="mt-3 font-black text-orange-600 uppercase tracking-tighter text-base whitespace-nowrap">
                Solstice Cafe
            </span>
        </div>
    </div>

    <nav class="mt-4 flex-1 px-4 space-y-2 overflow-y-auto">
        <div>
            <div class="border-t border-gray-100 w-full"></div>
        </div>

        <a href="{{ route('dashboard') }}"
            class="flex items-center justify-between p-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-orange-100 text-orange-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}"
            title="Pesanan Masuk">

            <div class="flex items-center">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>

                <span x-show="sidebarOpen" class="mx-3 whitespace-nowrap">
                    Pesanan Masuk
                </span>
            </div>

            {{-- Badge realtime --}}
            <span id="pendingBadge" class="hidden bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
            </span>

        </a>

        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.menu.create') }}"
                class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('admin.menu.*') ? 'bg-orange-100 text-orange-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}"
                title="Kelola Menu & Stok">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Kelola
                    Menu</span>
            </a>

            <a href="{{ route('admin.report.statistic') }}"
                class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('admin.report.*') ? 'bg-orange-100 text-orange-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}"
                title="Laporan Keuangan">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Laporan
                    Keuangan</span>
            </a>

            <a href="{{ route('admin.tables.kode_qr') }}"
                class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('admin.tables.*') ? 'bg-orange-100 text-orange-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}"
                title="Kelola QR Meja">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                    </path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">QR
                    Meja</span>
            </a>

            <a href="{{ route('profile.edit') }}"
                class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('profile.*') ? 'bg-orange-100 text-orange-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}"
                title="Pengaturan Profil">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Pengaturan
                    Profil</span>
            </a>
        @endif

        @if (Auth::user()->role === 'kasir')
            <a href="{{ route('cashier.reports.history') }}"
                class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('cashier.reports.*') ? 'bg-orange-100 text-orange-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}"
                title="Riwayat Transaksi">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">
                    Riwayat Transaksi</span>
            </a>

            <a href="{{ route('cashier.pos.order') }}"
                class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('cashier.pos.*') ? 'bg-orange-100 text-orange-700 font-bold' : 'text-gray-600 hover:bg-gray-100' }}"
                title="Transaksi Manual">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4h16v16H4V4zm4 4h8m-8 4h8m-8 4h8" />
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">
                    Kasir POS</span>
            </a>
        @endif

        <div class="pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center p-3 bg-red-600 text-white rounded-xl hover:bg-red-500 transition-all font-bold shadow-sm"
                    title="Keluar Sistem">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap text-sm">Keluar
                        Sistem</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
