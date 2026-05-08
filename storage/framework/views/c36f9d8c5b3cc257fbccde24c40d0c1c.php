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

    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" x-data="{
        search: '',
        showEditModal: false,
        editData: { id: '', name: '', category: '', stock: '', min_stock: '', unit: '' }
    }">

        
        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6 flex flex-col md:flex-row justify-between items-center gap-4">

            
            <div class="flex items-center gap-3 w-full md:w-auto">
                <div>
                    <h2 class="font-black text-lg text-gray-800 uppercase tracking-tighter">Inventaris Bahan
                    </h2>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Kelola stok gudang</p>
                </div>
            </div>

            
            <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
                
                <div
                    class="bg-gray-50 p-2 rounded-xl border border-gray-200 flex items-center gap-2 w-full sm:w-64 focus-within:border-orange-500 focus-within:bg-white transition-all">
                    <svg class="w-4 h-4 text-gray-400 ml-2 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" x-model="search" placeholder="Cari bahan..."
                        class="flex-1 px-2 py-1 text-xs font-black uppercase tracking-widest bg-transparent outline-none border-none focus:ring-0 text-gray-700 placeholder-gray-400 w-full">
                </div>

                
                <a href="<?php echo e(route('admin.inventory.add_stock')); ?>"
                    class="group flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-5 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-600/30 active:scale-95 w-full sm:w-auto justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah
                </a>
            </div>

        </div>

         <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-blue-500">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Total Bahan</p>
                <h3 class="text-2xl font-black text-blue-800 mt-1"><?php echo e($totalItems); ?> <span
                        class="text-sm text-gray-400 font-normal">Item</span></h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-green-500">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Stok Aman</p>
                <h3 class="text-2xl font-black text-green-600 mt-1"><?php echo e($safeStock); ?> <span
                        class="text-sm text-gray-400 font-normal">Item</span></h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-orange-500">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Stok Menipis</p>
                <h3 class="text-2xl font-black text-orange-600 mt-1"><?php echo e($lowStock); ?> <span
                        class="text-sm text-gray-400 font-normal">Item</span></h3>
            </div>
            <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-red-500">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Stok Habis</p>
                <h3 class="text-2xl font-black text-red-600 mt-1"><?php echo e($outOfStock); ?> <span
                        class="text-sm text-gray-400 font-normal">Item</span></h3>
            </div>
        </div>

        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
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
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr class="hover:bg-gray-50 transition-colors"
                            x-show="search === '' || '<?php echo e(strtolower(addslashes($item->name))); ?>'.includes(search.toLowerCase()) || '<?php echo e(strtolower($item->category)); ?>'.includes(search.toLowerCase())">
                            <td class="px-6 py-4 text-sm font-bold text-gray-800"><?php echo e($item->name); ?></td>
                            <td class="px-6 py-4 text-center text-sm font-black text-gray-700">
                                <?php echo e(number_format($item->stock, 0, ',', '.')); ?>

                                <span class="text-gray-400 font-medium"><?php echo e($item->unit); ?></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase <?php echo e($item->stock <= $item->min_stock ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'); ?>">
                                    <?php echo e($item->stock <= $item->min_stock ? 'Menipis' : 'Aman'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                
                                <button
                                    @click="
                                    editData = { 
                                        id: '<?php echo e($item->id); ?>', 
                                        name: '<?php echo e(addslashes($item->name)); ?>', 
                                        category: '<?php echo e($item->category); ?>', 
                                        
                                        stock: Math.round('<?php echo e($item->stock); ?>'), 
                                        min_stock: Math.round('<?php echo e($item->min_stock); ?>'), 
                                        unit: '<?php echo e($item->unit); ?>' 
                                    }; 
                                    showEditModal = true"
                                    class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider hover:bg-blue-600 hover:text-white transition-all">
                                    Edit
                                </button>

                                <form action="<?php echo e(route('admin.inventory.destroy', $item->id)); ?>" method="POST"
                                    class="inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button
                                        class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-wider hover:bg-red-600 hover:text-white transition-all">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>

        
        
        
        <div x-show="showEditModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showEditModal = false"></div>

            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden relative z-10 p-8"
                    @click.stop>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-black text-gray-800 uppercase tracking-tighter">Edit Bahan Baku</h3>
                        <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form :action="'/admin/inventory/' + editData.id" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-black uppercase text-gray-400 mb-1">Nama Bahan</label>
                                <input type="text" name="name" x-model="editData.name"
                                    class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                
                                <div>
                                    <label
                                        class="block text-xs font-black uppercase text-gray-400 mb-1">Kategori</label>
                                    <select name="category" x-model="editData.category"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500">
                                        <option value="Kopi & Teh">Kopi & Teh</option>
                                        <option value="Dairy & Cairan">Dairy & Cairan</option>
                                        <option value="Sirup & Pemanis">Sirup & Pemanis</option>
                                        <option value="Powder">Powder</option>
                                        <option value="Buah Segar">Buah Segar</option>
                                        <option value="Frozen Food">Frozen Food</option>
                                        <option value="Pastry & Dessert">Pastry & Dessert</option>
                                    </select>
                                </div>

                                
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Satuan</label>
                                    <select name="unit" x-model="editData.unit"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500">
                                        <option value="Gram">Gram</option>
                                        <option value="MiliLiter">MiliLiter</option>
                                        <option value="Liter">Liter</option>
                                        <option value="Botol">Botol</option>
                                        <option value="Pcs">Pcs</option>
                                        <option value="Slice">Slice</option>
                                        <option value="Scoop">Scoop</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Stok</label>
                                    <input type="number" step="1" name="stock" x-model="editData.stock"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-black uppercase text-gray-400 mb-1">Min
                                        Stok</label>
                                    <input type="number" step="1" name="min_stock"
                                        x-model="editData.min_stock"
                                        class="w-full border-gray-200 rounded-xl py-3 text-sm focus:ring-orange-500">
                                </div>
                            </div>

                            <div class="flex gap-3 pt-6">
                                <button type="button" @click="showEditModal = false"
                                    class="flex-1 bg-gray-100 text-gray-600 font-bold py-3 rounded-xl uppercase text-xs">Batal</button>
                                <button type="submit"
                                    class="flex-1 bg-orange-600 text-white font-black py-3 rounded-xl shadow-lg uppercase text-xs">Update
                                    Bahan</button>
                            </div>
                        </div>
                    </form>
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
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/admin/inventory/stock.blade.php ENDPATH**/ ?>