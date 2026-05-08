<aside x-data="{ sidebarOpen: false }" @mouseenter="sidebarOpen = true" @mouseleave="sidebarOpen = false"
    class="bg-orange-600 shadow-md h-screen transition-all duration-300 ease-in-out hidden md:flex flex-col border-r border-gray-100 sticky top-0 overflow-hidden w-20"
    :class="sidebarOpen ? 'w-64' : 'w-20'">

    
    <div class="h-40 w-full flex flex-col items-center justify-center relative flex-shrink-0">

        
        <a href="<?php echo e(route('dashboard')); ?>" class="block transition-all duration-300 ease-in-out z-10"
            :class="sidebarOpen ? '-translate-y-3' : 'translate-y-0'">
            <img src="<?php echo e(asset('storage/images/Solstice.png')); ?>" alt="Solstice Cafe Logo"
                class="rounded-full object-cover border-2 border-white ring-2 ring-orange-100 shadow-sm transition-all duration-300 hover:scale-105"
                :class="sidebarOpen ? 'h-20 w-20' : 'h-10 w-10'">
        </a>

        
        <span x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300 delay-100"
            x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute bottom-6 font-black text-white uppercase tracking-tighter text-base whitespace-nowrap">
            Solstice Cafe
        </span>
    </div>

    <nav class="flex-1 px-4 space-y-2 overflow-y-auto">
        <div>
            <div class="border-t border-white/20 w-full mb-4"></div>
        </div>

        <a href="<?php echo e(route('dashboard')); ?>"
            class="flex items-center justify-between p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('dashboard') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
            title="Pesanan Masuk">

            <div class="flex items-center">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>

                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">
                    Pesanan Masuk
                </span>
            </div>

            
            <span id="pendingBadge" class="hidden bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
            </span>
        </a>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->role === 'admin'): ?>
            <a href="<?php echo e(route('admin.menu.create')); ?>"
                class="flex items-center p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.menu.*') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
                title="Kelola Menu & Stok">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Kelola
                    Menu</span>
            </a>

            <a href="<?php echo e(route('admin.inventory.stock')); ?>"
                class="flex items-center p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.inventory.*') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
                title="Inventaris Bahan Baku">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                    </path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Inventaris
                    Bahan</span>
            </a>

            <a href="<?php echo e(route('admin.report.statistic')); ?>"
                class="flex items-center p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.report.*') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
                title="Laporan Keuangan">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Laporan
                    Keuangan</span>
            </a>

            <a href="<?php echo e(route('admin.tables.kode_qr')); ?>"
                class="flex items-center p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('admin.tables.*') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
                title="Kelola QR Meja">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                    </path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">QR
                    Meja</span>
            </a>

            <a href="<?php echo e(route('profile.edit')); ?>"
                class="flex items-center p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('profile.*') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
                title="Pengaturan Profil">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Pengaturan
                    Profil</span>
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->role === 'kasir'): ?>
            <a href="<?php echo e(route('cashier.pos.order')); ?>"
                class="flex items-center p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('cashier.pos.*') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
                title="Transaksi Manual">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4h16v16H4V4zm4 4h8m-8 4h8m-8 4h8" />
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">
                    Kasir POS</span>
            </a>

            <a href="<?php echo e(route('cashier.reports.history')); ?>"
                class="flex items-center p-3 rounded-lg transition-colors <?php echo e(request()->routeIs('cashier.reports.*') ? 'bg-white text-orange-700 font-bold' : 'text-white hover:shadow-lg'); ?>"
                title="Riwayat Transaksi">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">
                    Riwayat Transaksi</span>
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="pt-4 border-t border-white/20 mb-4">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="w-full flex items-center p-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-all font-bold shadow-sm"
                    title="Keluar Sistem">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.origin.left class="mx-3 whitespace-nowrap">Keluar
                        Sistem</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>