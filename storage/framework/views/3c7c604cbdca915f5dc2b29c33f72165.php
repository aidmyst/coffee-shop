<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="py-6">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 transition-all">
            
            
            <div class="max-w-full mx-auto mb-6">
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6 flex flex-wrap justify-between items-center gap-4">

                    
                    <div>
                        <h3 class="font-black text-lg text-gray-800 uppercase tracking-tighter">
                            Riwayat Transaksi
                        </h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                            Daftar pesanan yang sudah selesai dibayar
                        </p>
                    </div>

                    
                    <div class="flex items-center gap-4">
                        
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <p class="text-2xl font-black text-orange-600 leading-none">
                                <?php echo e($orders->where('status', 'completed')->count()); ?>

                            </p>
                            <div class="flex flex-col">
                                <p class="text-[12px] text-gray-400 font-black uppercase tracking-widest leading-tight">
                                    Total Selesai
                                </p>
                                <p class="text-[12px] font-bold text-orange-700 uppercase tracking-tighter">
                                    Pesanan
                                </p>
                            </div>
                        </div>

                        
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <p class="text-2xl font-black text-green-600 leading-none">
                                Rp
                                <?php echo e(number_format($orders->where('status', 'completed')->sum('total_price'), 0, ',', '.')); ?>

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
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders->where('status', 'completed')->sortByDesc('updated_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center gap-1.5 text-center">

                                            
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($order->customer_name)): ?>
                                                <span
                                                    class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg font-black text-[10px] shadow-sm uppercase tracking-widest">
                                                    <?php echo e($order->customer_name); ?>

                                                </span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($order->table_number)): ?>
                                                <?php
                                                    $tableLower = strtolower($order->table_number);
                                                    // Daftar kata yang tidak boleh pakai imbuhan "Meja"
                                                    $isSpecial = in_array($tableLower, [
                                                        'takeaway',
                                                        'dine in',
                                                        'kasir',
                                                        'pos',
                                                    ]);
                                                ?>

                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSpecial): ?>
                                                    
                                                    <span
                                                        class="bg-gray-100 text-gray-500 px-3 py-1 rounded-lg font-black text-[10px] shadow-sm uppercase tracking-widest">
                                                        <?php echo e($order->table_number); ?>

                                                    </span>
                                                <?php else: ?>
                                                    
                                                    <span
                                                        class="bg-orange-600 text-white px-3 py-1 rounded-lg font-black text-[10px] shadow-sm uppercase tracking-widest">
                                                        Meja <?php echo e($order->table_number); ?>

                                                    </span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        </div>
                                    </td>

                                    
                                    <td class="px-6 py-4 text-center text-center">
                                        <p class="text-[14px] font-bold text-gray-700">
                                            <?php echo e($order->created_at->format('H:i')); ?></p>
                                        <p class="text-[14px] text-gray-400 font-medium uppercase">WIB</p>
                                    </td>

                                    
                                    <td class="px-6 py-4">
                                        <div class="space-y-4 px-8">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = json_decode($order->items) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                                <div
                                                    class="flex flex-col border-b border-gray-100 last:border-none pb-2">

                                                    
                                                    <div class="flex justify-between items-center w-full">
                                                        <span class="font-bold text-gray-800 text-sm tracking-tight">
                                                            <?php echo e($item->name); ?>

                                                        </span>

                                                        <span class="text-gray-500 font-medium text-xs">
                                                            x<?php echo e($item->qty); ?>

                                                        </span>
                                                    </div>

                                                    
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item->option) || !empty($item->sugar)): ?>
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item->option)): ?>
                                                                <?php echo e($item->option); ?>

                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                            
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item->option) && !empty($item->sugar)): ?>
                                                                •
                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                            
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($item->sugar)): ?>
                                                                <?php echo e($item->sugar); ?>

                                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                        </div>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                    </td>

                                    
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center text-center">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->note): ?>
                                                <div class="max-w-[150px]">
                                                    <p
                                                        class="text-[14px] text-gray-600 italic leading-relaxed p-2 rounded-lg bg-yellow-50/50 border border-yellow-100">
                                                        "<?php echo e($order->note); ?>"
                                                    </p>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-gray-300 text-[14px] italic">Tidak ada catatan</span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </td>

                                    
                                    <td class="px-6 py-4 text-center font-black text-gray-800 text-sm">
                                        Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?>

                                    </td>

                                    
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <span
                                                class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-green-200">
                                                Paid
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/cashier/reports/history.blade.php ENDPATH**/ ?>