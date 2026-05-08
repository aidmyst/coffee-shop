<?php if (isset($component)) { $__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.public-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('public-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php $categories = ['Coffee', 'Non-Coffee', 'Tea', 'Juice', 'Snack', 'Dessert']; ?>

    <div class="max-w-full mx-auto bg-gray-50 min-h-screen pb-6 font-sans" x-data="Object.assign(cartSystem(), {
        showItemModal: false,
        showCartModal: false,
        selectedItem: null,
        sugarLevel: 'Normal Sugar',
        tempOption: 'Ice',
        qty: 1
    })">

        
        <header class="w-full sticky top-0 z-50">

            
            <div class="bg-white py-3 px-5 flex justify-between items-center border-b border-gray-50">
                
                <div>
                    <h1 class="text-[18px] font-black text-orange-600 tracking-tight uppercase italic">Solstice Cafe</h1>
                </div>

                
                <div class="flex items-center gap-2">
                    <span class="text-[14px] font-black text-gray-400 uppercase tracking-[0.2em]">Table</span>
                    <div
                        class="w-10 h-10 bg-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-600/20 rotate-3">
                        <span class="text-white text-lg font-black -rotate-3 leading-none">
                            <?php echo e($table_number); ?>

                        </span>
                    </div>
                </div>
            </div>

            
            <div class="bg-white border-b border-gray-100 shadow-sm overflow-hidden">
                <div class="flex overflow-x-auto custom-scrollbar-hide py-3 px-4 gap-2 scroll-smooth">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <button @click="scrollToCategory('cat-<?php echo e(Str::slug($cat)); ?>')"
                            class="whitespace-nowrap px-5 py-2 text-[10px] font-black uppercase tracking-widest rounded-full border border-orange-200/50 bg-white/80 text-gray-700 hover:bg-orange-600 hover:text-white transition-all active:scale-90 flex-shrink-0 shadow-sm">
                            <?php echo e($cat); ?>

                        </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </header>

        
        <div class="space-y-8" :class="cart.length > 0 ? 'pb-24' : 'pb-4'">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menus->where('category', $cat)->count() > 0): ?>
                    <div class="mt-8 px-4 first:mt-4">
                        
                        
                        <h2 id="cat-<?php echo e(Str::slug($cat)); ?>"
                            class="text-[11px] font-black text-gray-500 uppercase tracking-[0.2em] mb-4 flex items-center gap-3 scroll-mt-[135px] md:scroll-mt-[150px]">
                            <span class="w-8 h-[2px] bg-orange-500"></span>
                            <?php echo e($cat); ?>

                        </h2>

                        <div class="grid grid-cols-3 md:grid-cols-6 lg:grid-cols-10 gap-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $menus->where('category', $cat); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                
                                <div
                                    class="bg-white rounded-2xl p-2 shadow-[0_2px_10px_-3px_rgba(0,0,0,0.07)] border border-gray-100 flex flex-col h-full transition-all duration-200 
                                    <?php echo e(!($menu->is_available ?? true) ? 'opacity-60 grayscale select-none' : 'active:scale-[0.96]'); ?>">

                                    
                                    <div
                                        class="aspect-square rounded-xl bg-gray-50 overflow-hidden relative group flex-shrink-0">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menu->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $menu->image)); ?>"
                                                class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-200">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!($menu->is_available ?? true)): ?>
                                            <div
                                                class="absolute inset-0 bg-black/30 flex items-center justify-center backdrop-blur-[1px]">
                                                <span
                                                    class="bg-red-600 text-white text-center font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-widest shadow-xl">
                                                    Out Of Stock
                                                </span>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>

                                    
                                    <div class="flex flex-col flex-1 mt-3 w-full box-border">
                                        
                                        <h3
                                            class="font-extrabold text-gray-800 text-[14px] md:text-[11px] leading-tight line-clamp-2 text-center">
                                            <?php echo e($menu->name); ?>

                                        </h3>

                                        
                                        <div class="mt-auto">
                                            
                                            <?php
                                                if (Str::contains(strtolower($menu->name), 'lychee')) {
                                                    $price = $menu->price_ice ?? $menu->price_hot;
                                                } else {
                                                    $price = $menu->price_hot ?? $menu->price_ice;
                                                }
                                            ?>

                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($price): ?>
                                                <div
                                                    class="flex items-center justify-between bg-gray-100/50 rounded-md w-full mt-2 px-2 py-1 border border-gray-100">
                                                    <span
                                                        class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Price</span>
                                                    <span
                                                        class="text-orange-600 font-black text-[12px]"><?php echo e(number_format($price / 1000, 0)); ?>k</span>
                                                </div>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                            
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$menu->is_available): ?>
                                                
                                                <button disabled
                                                    class="mt-2 w-full bg-red-50 border border-red-100 text-red-500 text-[12px] font-black py-2 rounded-lg cursor-not-allowed flex items-center justify-center gap-1 opacity-90">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3"
                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                                        </path>
                                                    </svg>
                                                    Stok Habis
                                                </button>
                                            <?php else: ?>
                                                
                                                <button
                                                    @click="openItemModal({
                                                        name: '<?php echo e(addslashes($menu->name)); ?>',
                                                        image: '<?php echo e($menu->image ? asset('storage/' . $menu->image) : ''); ?>',
                                                        price_hot: <?php echo e($menu->price_hot ?? 0); ?>,
                                                        price_ice: <?php echo e($menu->price_ice ?? 0); ?>,
                                                        category: '<?php echo e(addslashes($cat)); ?>'
                                                    })"
                                                    class="mt-2 w-full bg-gray-900 text-white text-[12px] font-black py-2 rounded-lg flex items-center justify-center gap-1 transition-colors shadow-sm active:scale-95">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                    Add
                                                </button>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        <div x-show="showItemModal" x-transition:enter="transition-transform duration-300"
            x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0"
            x-transition:leave="transition-transform duration-300" x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full"
            x-effect="document.body.style.overflow = showItemModal ? 'hidden' : 'auto'"
            class="fixed inset-0 z-50 flex items-end justify-center overscroll-none">

            <div x-ref="modal"
                class="bg-white w-full md:max-w-md rounded-t-3xl shadow-2xl flex flex-col h-[80vh] overflow-hidden">

                <!-- HEADER DRAG -->
                <div @touchstart="onTouchStart($event)" @touchmove="onTouchMove($event)" @touchend="onTouchEnd()"
                    class="flex items-center justify-between py-3 px-5 border-b">
                    <h2 class="text-xs font-black text-gray-800 uppercase tracking-widest">
                        Detail Menu
                    </h2>
                    <button @click="showItemModal = false"
                        class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- SCROLL AREA -->
                <div x-ref="scrollArea" class="overflow-y-auto overscroll-contain p-5 pb-1 flex-1">

                    <!-- IMAGE -->
                    <div class="aspect-square rounded-2xl overflow-hidden mb-4">
                        <img :src="selectedItem?.image" class="w-full h-full object-cover">
                    </div>

                    <!-- NAME + PRICE -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-black text-gray-800" x-text="selectedItem?.name"></h3>
                        <p class="text-base font-black text-orange-600">
                            Rp<span
                                x-text="(selectedItem?.name === 'Cold Brew' || selectedItem?.name.toLowerCase().includes('lychee')) 
                                ? selectedItem?.price_ice.toLocaleString('id-ID') 
                                : (selectedItem?.price_hot ? selectedItem.price_hot.toLocaleString('id-ID') : 0)">
                            </span>
                        </p>
                    </div>

                    <!-- SUGAR LEVEL -->
                    <div class="mb-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-200"
                        x-show="selectedItem?.category !== 'Snack' && selectedItem?.category !== 'Dessert' && selectedItem?.name !== 'Espresso' && selectedItem?.name !== 'Mineral Water'">
                        <!-- Header flex: Title + Opsional -->
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-xs font-bold text-gray-500 uppercase">Sugar Level</p>
                        </div>

                        <!-- Pilihan -->
                        <div class="flex flex-col">
                            <template x-for="(s, index) in ['No Sugar','Less Sugar','Normal Sugar','Extra Sugar']"
                                :key="s">
                                <div>
                                    <button type="button" @click="sugarLevel = s"
                                        class="flex items-center justify-between py-2.5 px-3 w-full">

                                        <!-- Checkbox + Label -->
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 border rounded-sm flex items-center justify-center flex-shrink-0"
                                                :class="sugarLevel === s ? 'bg-orange-600 border-orange-600' :
                                                    'border-gray-300'">
                                                <svg x-show="sugarLevel === s" class="w-3 h-3 text-white"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-bold text-gray-700" x-text="s"></span>
                                        </div>
                                        <span class="text-[10px] font-bold text-green-600 uppercase">Free</span>
                                    </button>

                                    <!-- Garis pembatas -->
                                    <div x-show="index < 3" class="border-t border-gray-200 mx-3"></div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- TEMPERATURE -->
                    <div class="mb-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-200"
                        x-show="selectedItem?.category !== 'Snack' && selectedItem?.category !== 'Dessert' && 
                        selectedItem?.name !== 'Espresso' && 
                        !selectedItem?.name.toLowerCase().includes('lychee') &&
                        selectedItem?.name !== 'Cold Brew'">

                        <div class="flex justify-between items-center mb-2">
                            <p class="text-xs font-bold text-gray-500 uppercase">Temperature</p>
                        </div>
                        <div class="flex flex-col">

                            <!-- ============================= -->
                            <!-- KHUSUS MINERAL WATER -->
                            <!-- ============================= -->
                            <template
                                x-if="selectedItem?.name === 'Mineral Water' || selectedItem?.category === 'Juice'">
                                <div>
                                    <!-- NORMAL -->
                                    <button type="button" @click="tempOption='Normal'"
                                        class="flex items-center justify-between py-2 px-3 w-full">
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 border rounded-sm flex items-center justify-center"
                                                :class="tempOption === 'Normal' ? 'bg-orange-600 border-orange-600' :
                                                    'border-gray-300'">
                                                <svg x-show="tempOption === 'Normal'" class="w-3 h-3 text-white"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-bold text-gray-700">Normal</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-green-600 uppercase">Free</span>
                                    </button>

                                    <div class="border-t border-gray-200 mx-3"></div>

                                    <!-- ICE -->
                                    <button type="button" @click="tempOption='Ice'"
                                        class="flex items-center justify-between py-2 px-3 w-full">
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 border rounded-sm flex items-center justify-center"
                                                :class="tempOption === 'Ice' ? 'bg-orange-600 border-orange-600' :
                                                    'border-gray-300'">
                                                <svg x-show="tempOption === 'Ice'" class="w-3 h-3 text-white"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-bold text-gray-700">Ice</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-orange-600">+2.000</span>
                                    </button>
                                </div>
                            </template>

                            <!-- ============================= -->
                            <!-- MENU NORMAL (HOT / ICE) -->
                            <!-- ============================= -->
                            <template
                                x-if="selectedItem?.name !== 'Mineral Water' && selectedItem?.category !== 'Juice'">
                                <div>
                                    <!-- HOT -->
                                    <button type="button" @click="tempOption='Hot'"
                                        class="flex items-center justify-between py-2 px-3 w-full">
                                        <div class="flex items-center gap-3">
                                            <div class="w-4 h-4 border rounded-sm flex items-center justify-center"
                                                :class="tempOption === 'Hot' ? 'bg-orange-600 border-orange-600' :
                                                    'border-gray-300'">
                                                <svg x-show="tempOption === 'Hot'" class="w-3 h-3 text-white"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                            <span class="text-xs font-bold text-gray-700">Hot</span>
                                        </div>
                                        <span class="text-[10px] font-bold text-green-600 uppercase">Free</span>
                                    </button>

                                    <div class="border-t border-gray-200 mx-3"></div>

                                    <!-- ICE -->
                                    <template x-if="selectedItem?.name !== 'Espresso'">
                                        <button type="button" @click="tempOption='Ice'"
                                            class="flex items-center justify-between py-2 px-3 w-full">

                                            <div class="flex items-center gap-3">
                                                <div class="w-4 h-4 border rounded-sm flex items-center justify-center"
                                                    :class="tempOption === 'Ice' ? 'bg-orange-600 border-orange-600' :
                                                        'border-gray-300'">
                                                    <svg x-show="tempOption === 'Ice'" class="w-3 h-3 text-white"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="3" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>

                                                <span class="text-xs font-bold text-gray-700">Ice</span>
                                            </div>

                                            <span class="text-[10px] font-bold text-orange-600">+2.000</span>
                                        </button>
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- FIXED BOTTOM -->
                <div class="p-3 border-t bg-white shadow-[0_-6px_20px_rgba(0,0,0,0.08)]">
                    <div class="flex items-center justify-between mb-2">
                         <div
                            class="flex items-center gap-4 bg-gray-50 rounded-2xl px-4 py-2 border border-gray-100">
                            <button @click="if(qty>1) qty--"
                                class="font-black text-orange-600 text-xl w-6 h-6 flex items-center justify-center active:scale-75 transition-transform">
                                -
                            </button>

                            <span class="font-black text-sm w-4 text-center text-gray-800" x-text="qty"></span>

                            <button @click="qty++"
                                class="font-black text-orange-600 text-xl w-6 h-6 flex items-center justify-center active:scale-75 transition-transform">
                                +
                            </button>
                        </div>
                        <p class="text-base font-black text-orange-600">
                            Rp<span x-text="calculateItemPrice().toLocaleString('id-ID')"></span>
                        </p>
                    </div>
                    <button @click="if(validateOptions()) saveCartChanges()"
                        class="w-full bg-orange-600 text-white py-2.5 rounded-xl font-bold text-sm tracking-wide shadow-md">
                        <span x-text="editingIndex !== null ? 'Update Item' : 'Add To Cart'"></span>
                    </button>
                </div>

            </div>
        </div>

        
        <template x-if="cart.length > 0 && !showItemModal">
            <div class="fixed bottom-6 left-4 right-4 z-50 flex flex-col gap-2">

                
                <div @click="showCartModal = true"
                    class="bg-orange-600 text-white p-3 rounded-[2rem] shadow-2xl flex justify-between items-center cursor-pointer active:scale-[0.98] transition">

                    <div class="flex items-center gap-3 px-2">

                        
                        <div class="relative select-none">
                            <div class="p-2.5">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>

                            
                            <span
                                class="absolute -top-1.5 -right-1.5 bg-red-600 text-[9px] w-5 h-5 flex items-center justify-center rounded-full border-2 border-orange-600 font-black"
                                x-text="cart.reduce((a, b) => a + b.qty, 0)">
                            </span>
                        </div>

                        
                        <div class="select-none">
                            <p class="text-[7px] uppercase font-black text-orange-100 tracking-[0.2em]">Total</p>
                            <p class="text-sm font-black tracking-tight">
                                Rp<span x-text="totalPrice.toLocaleString('id-ID')"></span>
                            </p>
                        </div>
                    </div>

                    
                    <div class="text-white px-6 py-2 font-black text-[11px] uppercase tracking-widest">
                        View Cart
                    </div>

                </div>
            </div>
        </template>

        <div x-show="showCartModal" x-cloak x-transition:enter="transition duration-300 transform"
            x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition duration-300 transform"
            x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-full opacity-0"
            x-effect="document.body.style.overflow = showCartModal ? 'hidden' : 'auto'"
            class="fixed inset-0 z-[60] bg-white flex flex-col">

            
            <div class="flex items-center justify-between py-4 px-6 border-b border-gray-100 flex-shrink-0 bg-white">
                <h2 class="text-xs font-black text-gray-800 uppercase tracking-widest">
                    Your Cart
                </h2>
                <button @click="showCartModal = false"
                    class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            
            <div class="overflow-y-auto flex-1 px-6 py-4 custom-scrollbar">
                <template x-for="(item, index) in cart"
                    :key="item.name + '-' + item.option + '-' + item.sugar + '-' + index">

                    <div class="border-b border-gray-100 last:border-0 pb-6 mb-6">
                        <div class="flex justify-between items-center mb-6 last:mb-0">
                            <div class="flex-1 pr-4">
                                <p class="font-extrabold text-gray-800 text-base leading-tight" x-text="item.name">
                                </p>
                                <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mt-1">
                                    <span x-text="formatOptionSugar(item.option, item.sugar, item.name)"></span>
                                </p>
                                <p class="font-black text-orange-600 text-base mt-1.5">
                                    Rp<span x-text="(item.price * item.qty).toLocaleString('id-ID')"></span>
                                </p>
                            </div>

                            <div class="flex flex-col items-end gap-2">
                                <template
                                    x-if="item.category !== 'Snack' && item.category !== 'Dessert' && item.name.toLowerCase() !== 'espresso'">
                                    <button
                                        @click="showCartModal = false; setTimeout(() => openItemModal(item, index), 300)"
                                        class="flex items-center gap-1.5 text-[10px] font-black font-black uppercase bg-gray-50 px-3 py-1.5 rounded-2xl border border-gray-100 active:scale-95 transition-all group">

                                        <svg class="w-3 h-3 font-black group-hover:rotate-12 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>

                                        <span>Edit</span>
                                    </button>
                                </template>

                                <div
                                    class="flex items-center gap-4 bg-gray-50 rounded-2xl px-4 py-2 border border-gray-100">
                                    <button
                                        @click="updateCart(item.name, item.price, -1, item.option, item.sugar, item.category)"
                                        class="font-black text-orange-600 text-xl w-6 h-6 flex items-center justify-center active:scale-75 transition-transform">-</button>
                                    <span class="font-black text-sm w-4 text-center text-gray-800"
                                        x-text="item.qty"></span>
                                    <button
                                        @click="updateCart(item.name, item.price, 1, item.option, item.sugar, item.category)"
                                        class="font-black text-orange-600 text-xl w-6 h-6 flex items-center justify-center active:scale-75 transition-transform">+</button>
                                </div>
                            </div>
                </template>

                
                <div class="mt-4">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 block">
                        Order Note (Optional)
                    </label>
                    <textarea x-model="orderNote" placeholder="Example: Add spoon or fork please..."
                        class="w-full bg-white border border-gray-100 rounded-2xl text-sm p-4 focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 min-h-[80px] resize-none text-gray-700 shadow-sm"></textarea>
                </div>
            </div>

            
            <div class="border-t border-gray-100 p-6 flex-shrink-0 bg-gray-50/50">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Total
                            Price</span>
                        <span class="text-base font-black text-gray-800 mt-1">
                            Rp<span x-text="cart.reduce((a,b)=>a+b.price*b.qty,0).toLocaleString('id-ID')"></span>
                        </span>
                    </div>

                    <button @click="submitOrder()"
                        class="bg-orange-600 hover:bg-orange-500 text-white py-3 px-6 rounded-xl font-black text-sm tracking-wide shadow-md">
                        Checkout (<span x-text="cart.reduce((a,b)=>a+b.qty,0)"></span> Item)
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Sembunyikan scrollbar tapi tetap bisa scroll untuk slider kategori */
        .custom-scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .custom-scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script>
        function cartSystem() {
            return {
                tableNumber: '<?php echo e($table_number); ?>',
                cart: JSON.parse(localStorage.getItem('cafe_cart')) || [],
                totalPrice: 0,
                orderNote: localStorage.getItem('cafe_note') || '',

                showItemModal: false,
                showCartModal: false,
                selectedItem: null,
                editingIndex: null,

                // State Opsi (Global di scope cartSystem)
                sugarLevel: 'Normal Sugar',
                tempOption: 'Ice',
                qty: 1,

                // State untuk fitur drag modal
                startY: 0,
                currentY: 0,
                dragging: false,

                init() {
                    this.calculateTotal();
                    this.$watch('cart', (value) => {
                        localStorage.setItem('cafe_cart', JSON.stringify(value));
                        this.calculateTotal();
                    });

                    this.$watch('orderNote', (value) => {
                        localStorage.setItem('cafe_note', value);
                    });

                    // Reset posisi modal saat ditutup
                    this.$watch('showItemModal', (value) => {
                        if (!value) {
                            this.currentY = 0;
                            if (this.$refs.modal) this.$refs.modal.style.transform = `translateY(0)`;
                        } else {
                            this.$nextTick(() => {
                                if (this.$refs.scrollArea) this.$refs.scrollArea.scrollTop = 0;
                            });
                        }
                    });
                },

                // Handler Drag Modal
                onTouchStart(e) {
                    this.dragging = true;
                    this.startY = e.touches[0].clientY;
                },
                onTouchMove(e) {
                    if (!this.dragging) return;
                    this.currentY = e.touches[0].clientY - this.startY;
                    if (this.currentY > 0) {
                        this.$refs.modal.style.transform = `translateY(${this.currentY}px)`;
                    }
                },
                onTouchEnd() {
                    this.dragging = false;
                    if (this.currentY > 100) {
                        this.showItemModal = false;
                    } else {
                        this.$refs.modal.style.transform = `translateY(0)`;
                    }
                    this.currentY = 0;
                },

                validateOptions() {
                    if (!this.selectedItem) return false;
                    const cat = this.selectedItem.category;
                    const name = this.selectedItem.name;

                    const needSugar = cat !== 'Snack' && cat !== 'Dessert' && name !== 'Espresso' && name !==
                        'Mineral Water';
                    const needTemp = cat !== 'Snack' && cat !== 'Dessert' && name !== 'Espresso' &&
                        !name.toLowerCase().includes('lychee') && name !== 'Cold Brew';

                    if (needSugar && !this.sugarLevel) {
                        alert('Silakan pilih Sugar Level');
                        return false;
                    }
                    if (needTemp && !this.tempOption) {
                        alert('Silakan pilih Temperature');
                        return false;
                    }
                    return true;
                },

                openItemModal(item, index = null) {
                    this.selectedItem = item;
                    this.editingIndex = index;
                    this.showItemModal = true;

                    if (index !== null) {
                        // MODE UPDATE: Tetap ingat pilihan sebelumnya
                        this.qty = item.qty;
                        this.sugarLevel = item.sugar || '';
                        this.tempOption = item.option || '';
                    } else {
                        // MODE BARU: Reset total & kosongkan opsi
                        this.qty = 1;
                        this.sugarLevel = ''; // Selalu kosong agar user pilih sendiri manisnya

                        const itemName = item.name.toLowerCase();
                        const category = item.category;

                        if (category === 'Snack' || category === 'Dessert') {
                            this.tempOption = 'Normal';
                        } else if (itemName.includes('lychee') || itemName === 'cold brew') {
                            // Khusus menu ini, otomatis 'Ice' tapi sugar tetap kosong
                            this.tempOption = 'Ice';
                        } else if (itemName === 'espresso') {
                            // Khusus espresso otomatis 'Hot' dan 'No Sugar'
                            this.tempOption = '';
                            this.sugarLevel = '';
                        } else {
                            // Minuman umum lainnya (Kopi/Tea biasa) dibuat kosong semua
                            this.tempOption = '';
                            this.sugarLevel = '';
                        }
                    }
                },

                saveCartChanges() {
                    if (!this.validateOptions()) return;

                    const category = this.selectedItem.category;
                    const itemName = this.selectedItem.name.toLowerCase();
                    let price;

                    // Hitung harga
                    if (category === 'Snack' || category === 'Dessert' || itemName === 'espresso') {
                        price = this.selectedItem.price_hot;
                    } else if (itemName === 'cold brew' || itemName.includes('lychee')) {
                        price = this.selectedItem.price_ice;
                    } else {
                        price = (this.tempOption === 'Hot' || this.tempOption === 'Normal') ?
                            this.selectedItem.price_hot : this.selectedItem.price_ice;
                    }

                    const sugar = (category === 'Snack' || category === 'Dessert') ? '' : this.sugarLevel;
                    const option = (category === 'Snack' || category === 'Dessert') ? '' : this.tempOption;

                    if (this.editingIndex !== null) {
                        // Update item di index tertentu
                        this.cart[this.editingIndex] = {
                            ...this.cart[this.editingIndex],
                            price: parseInt(price) || 0,
                            qty: this.qty,
                            option: option,
                            sugar: sugar
                        };
                        this.cart = [...this.cart];
                        this.showCartModal = true;
                    } else {
                        // Add baru atau merge
                        let existingItem = this.cart.find(i =>
                            i.name === this.selectedItem.name && i.option === option && i.sugar === sugar
                        );

                        if (existingItem) {
                            existingItem.qty += this.qty;
                            this.cart = [...this.cart];
                        } else {
                            this.cart.push({
                                name: this.selectedItem.name,
                                price: parseInt(price) || 0,
                                qty: this.qty,
                                option: option,
                                sugar: sugar,
                                price_hot: parseInt(this.selectedItem.price_hot) || 0,
                                price_ice: parseInt(this.selectedItem.price_ice) || 0,
                                category: category,
                                image: this.selectedItem.image
                            });
                        }
                    }
                    this.showItemModal = false;
                },

                updateCart(name, price, qty, option, sugar = '', category = '') {
                    let item = this.cart.find(i =>
                        i.name === name && (i.option || '') === (option || '') && (i.sugar || '') === (sugar || '')
                    );

                    if (item) {
                        item.qty += qty;
                        if (item.qty <= 0) {
                            this.cart = this.cart.filter(i => i !== item);
                        } else {
                            this.cart = [...this.cart];
                        }
                    }
                    if (this.cart.length === 0) this.showCartModal = false;
                },

                calculateItemPrice() {
                    if (!this.selectedItem) return 0;
                    let basePrice = 0;
                    const category = this.selectedItem.category;
                    const itemName = this.selectedItem.name.toLowerCase();

                    if (category === 'Snack' || category === 'Dessert' || itemName === 'espresso') {
                        basePrice = this.selectedItem.price_hot;
                    } else if (itemName === 'cold brew' || itemName.includes('lychee')) {
                        basePrice = this.selectedItem.price_ice;
                    } else {
                        basePrice = (this.tempOption === 'Hot' || this.tempOption === 'Normal') ?
                            this.selectedItem.price_hot : this.selectedItem.price_ice;
                    }
                    return (parseInt(basePrice) || 0) * this.qty;
                },

                calculateTotal() {
                    this.totalPrice = this.cart.reduce((sum, item) => sum + (parseInt(item.price) * item.qty), 0);
                },

                scrollToCategory(id) {
                    const element = document.getElementById(id);
                    if (element) {
                        const headerOffset = 135;
                        const elementPosition = element.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                },

                formatOptionSugar(option, sugar, name = '') { // Tambahkan parameter name
                    let parts = [];

                    const lowerName = name.toLowerCase();
                    // Cek apakah ini Mineral Water atau Juice
                    const isBasicDrink = name === 'Mineral Water' || name.toLowerCase().includes('juice');

                    if (option) {
                        // Jika Mineral Water/Juice, tampilkan apapun opsinya (termasuk Normal)
                        // Jika menu lain, sembunyikan tulisan 'Normal'
                        if (isBasicDrink || option !== 'Normal') {
                            parts.push(option);
                        }
                    }

                    if (sugar) parts.push(sugar);
                    return parts.join(' • ');
                },

                async submitOrder() {
                    if (this.cart.length === 0) return;
                    const tokenTag = document.querySelector('meta[name="csrf-token"]');
                    if (!confirm('Kirim pesanan Meja ' + this.tableNumber + '?')) return;

                    try {
                        const response = await fetch('/order/submit', { // Pastikan URL ini sama dengan route
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': tokenTag.getAttribute('content'),
                                'Accept': 'application/json' // BARIS INI WAJIB ADA agar Controller tahu ini AJAX
                            },
                            body: JSON.stringify({
                                table_number: this.tableNumber,
                                customer_name: null, // Kustomer meja tidak perlu input nama
                                cart: this.cart,
                                total_price: this.totalPrice,
                                note: this.orderNote
                            })
                        });

                        if (response.ok) {
                            alert('Pesanan Berhasil dikirim!');
                            this.cart = [];
                            this.orderNote = '';
                            localStorage.clear();
                            this.showCartModal = false;
                        } else {
                            alert('Gagal mengirim pesanan.');
                        }
                    } catch (error) {
                        alert('Terjadi kesalahan jaringan.');
                    }
                }
            }
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b)): ?>
<?php $attributes = $__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b; ?>
<?php unset($__attributesOriginal58c831a7c3cbf004f2e66a23aed50e5b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b)): ?>
<?php $component = $__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b; ?>
<?php unset($__componentOriginal58c831a7c3cbf004f2e66a23aed50e5b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/public/menu.blade.php ENDPATH**/ ?>