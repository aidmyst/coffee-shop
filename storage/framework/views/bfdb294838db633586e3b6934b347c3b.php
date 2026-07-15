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

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-8" x-data="{ search: '' }">
        
        <div class="flex items-center gap-5 mb-8">

            
            <a href="<?php echo e(route('admin.menu.index')); ?>"
                class="group flex items-center justify-center w-12 h-12 bg-white rounded-2xl shadow-sm border border-gray-100 hover:bg-orange-500 hover:border-orange-500 hover:shadow-orange-500/30 transition-all duration-300 ease-out shrink-0">

                
                <svg class="w-6 h-6 text-orange-500 group-hover:text-white transition-colors duration-300 ease-out"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                </svg>
            </a>

            
            <div class="flex-1">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                    <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight flex items-center gap-2">
                        
                        <svg class="w-7 h-7 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        Buku Resep
                    </h2>

                    
                    <div
                        class="inline-flex items-center px-3 py-1 rounded-lg bg-orange-100 border border-orange-200 text-orange-700 shadow-sm mt-1 sm:mt-0 w-fit">
                        <span class="w-2 h-2 rounded-full bg-orange-500 mr-2 animate-pulse"></span>
                        <span class="text-sm font-black uppercase tracking-widest"><?php echo e($menu->name); ?></span>
                    </div>
                </div>

                <p class="text-sm text-gray-500 font-bold mt-2 ml-1">
                    Tentukan komposisi bahan baku yang akan dipotong saat menu ini dipesan
                </p>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div
                class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl font-bold text-sm">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="mb-4 bg-white p-2 rounded-xl shadow-sm border flex items-center gap-2 max-w-sm">
            <svg class="w-4 h-4 text-gray-400 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" x-model="search" placeholder="Cari bahan baku..."
                class="flex-1 px-2 py-1.5 text-xs font-black uppercase tracking-widest bg-transparent outline-none border-none focus:ring-0 text-gray-600 placeholder-gray-400">
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden p-6">
            <form action="<?php echo e(route('admin.menu.recipe.store', $menu->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead
                            class="bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-t">
                            <tr>
                                <th class="px-4 py-3">Nama Bahan Baku di Gudang</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Sisa Stok</th>
                                <th class="px-4 py-3 text-right">Kebutuhan Per Porsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                <tr class="hover:bg-gray-50 transition-colors"
                                    x-show="search === '' || '<?php echo e(strtolower(addslashes($item->name))); ?>'.includes(search.toLowerCase()) || '<?php echo e(strtolower($item->category)); ?>'.includes(search.toLowerCase())">
                                    <td class="px-4 py-3">
                                        <p class="font-bold text-gray-800 text-sm"><?php echo e($item->name); ?></p>
                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-500 font-medium">
                                        <?php echo e($item->category); ?>

                                    </td>
                                    <td class="px-4 py-3 text-xs text-gray-500 font-medium">
                                        <?php echo e(number_format($item->stock, 0, ',', '.')); ?> <?php echo e($item->unit); ?>

                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            
                                            <input type="number" step="1" min="0"
                                                name="ingredients[<?php echo e($item->id); ?>][quantity]"
                                                value="<?php echo e(isset($currentRecipe[$item->id]) ? round($currentRecipe[$item->id]) : ''); ?>"
                                                placeholder="0"
                                                class="w-24 bg-white border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 p-2 text-right">
                                            <span
                                                class="text-xs font-bold text-gray-400 w-10 text-left"><?php echo e($item->unit); ?></span>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-600/30">
                        Simpan Resep
                    </button>
                </div>
            </form>
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
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/admin/menu/recipe.blade.php ENDPATH**/ ?>