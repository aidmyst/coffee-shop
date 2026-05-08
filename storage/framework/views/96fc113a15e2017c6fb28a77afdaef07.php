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

    <div class="py-6" x-data="Object.assign(cartSystem(), {
        showItemModal: false,
        selectedItem: null,
        sugarLevel: '',
        tempOption: '',
        qty: 1,
        search: ''
    })">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-12 gap-6">
                
                <div class="col-span-7 flex flex-col gap-6">
                    
                    <div
                        class="bg-white shadow-sm border border-gray-100 rounded-xl p-3 flex items-center gap-3 sticky top-6 z-40">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" x-model="search" placeholder="Cari menu..."
                            class="w-full outline-none text-sm text-gray-700 placeholder-gray-400 bg-gray-50 px-3 py-2 rounded-lg border-none focus:ring-0">
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['Coffee', 'Non-Coffee', 'Tea', 'Juice', 'Snack', 'Dessert']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menus->where('category', $cat)->count() > 0): ?>
                            <div x-show="search === '' || <?php echo e($menus->where('category', $cat)->pluck('name')->map(fn($n) => strtolower($n))->values()->toJson()); ?>.some(name => name.includes(search.toLowerCase()))"
                                x-transition class="bg-white p-4 shadow sm:rounded-2xl border">

                                <div class="flex justify-between items-center border-b pb-2 mb-4">
                                    <h3 class="text-md font-black text-gray-800 uppercase tracking-widest">
                                        <span class="text-orange-600 mr-2">|</span><?php echo e($cat); ?>

                                    </h3>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $menus->where('category', $cat); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                        
                                        <div x-show="search === '' || '<?php echo e(strtolower($menu->name)); ?>'.includes(search.toLowerCase())"
                                            class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all flex flex-col h-full group 
                                            <?php echo e($menu->is_available ? 'hover:shadow-md hover:border-orange-200' : 'opacity-60 grayscale pointer-events-none'); ?>">

                                            
                                            <div class="aspect-square w-full bg-gray-50 overflow-hidden relative">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($menu->image): ?>
                                                    <img src="<?php echo e(asset('storage/' . $menu->image)); ?>"
                                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                                <?php else: ?>
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-gray-300">
                                                        <svg class="w-10 h-10" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" />
                                                        </svg>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                                
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$menu->is_available): ?>
                                                    <div
                                                        class="absolute inset-0 bg-black/40 flex items-center justify-center backdrop-blur-[1px]">
                                                        <span
                                                            class="bg-red-600 text-white font-black text-[10px] px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                                                            Stok Habis
                                                        </span>
                                                    </div>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>

                                            
                                            <div class="p-3 flex flex-col flex-1">
                                                
                                                <div
                                                    class="font-bold text-gray-800 text-[14px] leading-tight mb-3 min-h-[32px] line-clamp-2">
                                                    <?php echo e($menu->name); ?>

                                                </div>

                                                
                                                <button type="button"
                                                    <?php if($menu->is_available): ?> @click="openItemModal({
                                                            id: <?php echo e($menu->id); ?>,
                                                            name: '<?php echo e($menu->name); ?>',
                                                            category: '<?php echo e($menu->category); ?>',
                                                            image: '<?php echo e($menu->image ? asset('storage/' . $menu->image) : ''); ?>',
                                                            price_hot: <?php echo e($menu->price_hot ?? 0); ?>,
                                                            price_ice: <?php echo e($menu->price_ice ?? 0); ?>

                                                        })" 
                                                    <?php else: ?> 
                                                        disabled <?php endif; ?>
                                                    class="w-full py-3 px-4 rounded-xl font-black text-xs uppercase tracking-widest transition-all duration-200 flex items-center justify-center gap-2 
                                                    <?php echo e($menu->is_available ? 'bg-orange-600 text-white border border-orange-100 hover:bg-orange-700 active:scale-95' : 'bg-gray-100 text-gray-400 cursor-not-allowed border border-transparent'); ?>">

                                                    <?php echo e($menu->is_available ? 'Tambah' : 'Habis'); ?>


                                                </button>
                                            </div>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                
                
                <div class="col-span-5 relative">
                    <div class="bg-white p-6 shadow sm:rounded-2xl border sticky top-6 flex flex-col"
                        style="max-height: calc(100vh - 96px);">
                        <h4 class="font-semibold mb-4 text-gray-800 text-lg">Keranjang Kasir</h4>

                        
                        <div class="flex-1 overflow-y-auto space-y-3 pr-2 custom-scrollbar">
                            <template x-for="(item, index) in cart" :key="index">
                                <div class="flex justify-between items-center border-b pb-2">
                                    <div>
                                        <div x-text="item.name" class="font-bold text-gray-900 text-sm"></div>
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">
                                            <span x-text="formatOptionSugar(item.option, item.sugar, item.name)"></span>
                                        </div>
                                        <div class="text-gray-500 text-xs mt-1">
                                            Rp <span x-text="(item.price * item.qty).toLocaleString('id-ID')"></span>
                                        </div>
                                    </div>
                                    <div class="flex gap-3 items-center bg-gray-50 rounded-xl">
                                        <button @click="decreaseQty(index)"
                                            class="w-7 h-7 text-orange-600 font-black text-lg">-</button>
                                        <span x-text="item.qty" class="font-bold text-sm w-4 text-center"></span>
                                        <button @click="increaseQty(index)"
                                            class="w-7 h-7 text-orange-600 font-black text-lg">+</button>
                                    </div>
                                </div>
                            </template>
                            <div x-show="cart.length === 0" class="text-center text-gray-400 py-10 text-sm">Belum ada
                                pesanan.</div>
                        </div>

                        
                        <div class="mt-4 pt-4 border-t">
                            <div class="font-bold text-lg mb-4 flex justify-between">
                                <span>Total:</span>
                                <span>Rp <span x-text="totalPrice().toLocaleString('id-ID')"></span></span>
                            </div>

                            <form method="POST" action="<?php echo e(route('order.submit')); ?>" x-data="{ orderType: 'Takeaway' }"
                                @submit.prevent="
                                    $event.target.querySelector('[name=cart]').value = JSON.stringify(cart);
                                    $event.target.querySelector('[name=total_price]').value = totalPrice();
                                    $event.target.submit();
                                ">
                                <?php echo csrf_field(); ?>

                                
                                <div class="mb-3">
                                    <label
                                        class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Nama
                                        Pelanggan *</label>
                                    <input type="text" name="customer_name" required
                                        class="w-full border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 outline-none shadow-sm">
                                </div>

                                
                                <div class="mb-3">
                                    <label
                                        class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Catatan
                                        Pesanan (Opsional)</label>
                                    <textarea name="note" rows="2"
                                        class="w-full border-gray-200 rounded-xl px-3 py-2 text-sm focus:ring-orange-500 focus:border-orange-500 outline-none shadow-sm resize-none"></textarea>
                                </div>

                                
                                <div class="mb-4">
                                    <div class="flex gap-2">
                                        <button type="button" @click="orderType = 'Takeaway'"
                                            :class="orderType === 'Takeaway' ? 'bg-orange-500 text-white border-orange-500' :
                                                'bg-gray-50 text-gray-500 border-gray-200'"
                                            class="flex-1 py-3 rounded-xl text-xs font-bold transition-all border uppercase tracking-widest">Takeaway</button>
                                        <button type="button" @click="orderType = 'Dine In'"
                                            :class="orderType === 'Dine In' ? 'bg-orange-500 text-white border-orange-500' :
                                                'bg-gray-50 text-gray-500 border-gray-200'"
                                            class="flex-1 py-3 rounded-xl text-xs font-bold transition-all border uppercase tracking-widest">Dine
                                            In</button>
                                    </div>
                                </div>

                                <input type="hidden" name="table_number" :value="orderType">
                                <input type="hidden" name="cart">
                                <input type="hidden" name="total_price">

                                <button type="submit" :disabled="cart.length === 0"
                                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-black py-3 rounded-xl uppercase tracking-widest text-sm disabled:bg-gray-300 shadow-lg shadow-orange-600/20 transition-all active:scale-95">
                                    Submit Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div x-show="showItemModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-cloak>
            <div @click.away="showItemModal = false"
                class="bg-white w-full max-w-md rounded-2xl shadow-2xl flex flex-col max-h-[90vh] overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b">
                    <h2 class="text-sm font-black uppercase tracking-widest text-gray-800"
                        x-text="selectedItem?.name">
                    </h2>
                    <button @click="showItemModal = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="overflow-y-auto p-4 space-y-4">
                    <div x-show="(['Coffee', 'Non-Coffee', 'Tea', 'Juice'].includes(selectedItem?.category)) && selectedItem?.name !== 'Espresso' && selectedItem?.name !== 'Mineral Water'"
                        class="space-y-2">
                        <p class="text-xs font-bold text-gray-500 uppercase">Sugar Level</p>
                        <div class="grid grid-cols-2 gap-2">
                            <template x-for="s in ['No Sugar','Less Sugar','Normal Sugar','Extra Sugar']">
                                <button @click="sugarLevel = s"
                                    :class="sugarLevel === s ? 'bg-orange-600 text-white border-orange-600' :
                                        'bg-gray-50 border-gray-200'"
                                    class="py-2 px-3 text-xs font-bold rounded-xl border transition-all"
                                    x-text="s"></button>
                            </template>
                        </div>
                    </div>

                    <div x-show="!['Snack', 'Dessert'].includes(selectedItem?.category) && selectedItem?.name !== 'Espresso' && !selectedItem?.name.toLowerCase().includes('lychee') && selectedItem?.name !== 'Cold Brew'"
                        class="space-y-2">
                        <p class="text-xs font-bold text-gray-500 uppercase">Temperature</p>
                        <div class="flex gap-2">
                            <template
                                x-if="selectedItem?.name === 'Mineral Water' || selectedItem?.category === 'Juice'">
                                <div class="flex gap-2 w-full">
                                    <button @click="tempOption = 'Normal'"
                                        :class="tempOption === 'Normal' ? 'bg-orange-600 text-white border-orange-600' :
                                            'bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-bold rounded-xl border transition-all">Normal</button>
                                    <button @click="tempOption = 'Ice'"
                                        :class="tempOption === 'Ice' ? 'bg-orange-600 text-white border-orange-600' :
                                            'bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-bold rounded-xl border transition-all">Ice
                                        (+2k)</button>
                                </div>
                            </template>
                            <template
                                x-if="!['Mineral Water', 'Juice'].includes(selectedItem?.category) && selectedItem?.name !== 'Mineral Water'">
                                <div class="flex gap-2 w-full">
                                    <button @click="tempOption = 'Hot'"
                                        :class="tempOption === 'Hot' ? 'bg-orange-600 text-white border-orange-600' :
                                            'bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-bold rounded-xl border transition-all">Hot</button>
                                    <button @click="tempOption = 'Ice'"
                                        :class="tempOption === 'Ice' ? 'bg-orange-600 text-white border-orange-600' :
                                            'bg-gray-50'"
                                        class="flex-1 py-2 text-xs font-bold rounded-xl border transition-all">Ice
                                        (+2k)</button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="p-4 border-t bg-gray-50 flex flex-col gap-3">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-4 bg-white border px-3 py-1.5 rounded-xl">
                            <button @click="if(qty>1) qty--" class="text-orange-600 font-black text-lg">-</button>
                            <span x-text="qty" class="font-black text-sm w-4 text-center"></span>
                            <button @click="qty++" class="text-orange-600 font-black text-lg">+</button>
                        </div>
                        <div class="text-lg font-black text-gray-800">Rp <span
                                x-text="calculateItemPrice().toLocaleString('id-ID')"></span></div>
                    </div>
                    <button @click="addToCartFromModal()"
                        class="w-full bg-orange-600 text-white py-3 rounded-xl font-bold uppercase tracking-widest text-xs">Konfirmasi
                        Tambah</button>
                </div>
            </div>
        </div>
        <script>
            function cartSystem() {
                return {
                    cart: [],
                    openItemModal(item) {
                        this.selectedItem = item;
                        this.qty = 1;
                        this.sugarLevel = 'Normal Sugar';

                        const name = item.name.toLowerCase();
                        const cat = item.category;

                        if (name === 'espresso') {
                            this.tempOption = '';
                            this.sugarLevel = '';
                        } else if (cat === 'Snack' || cat === 'Dessert') {
                            this.tempOption = 'Hot';
                        } else if (name.includes('lychee') || name === 'cold brew') {
                            this.tempOption = 'Ice';
                        } else if (name === 'mineral water' || cat === 'Juice') {
                            this.tempOption = 'Normal';
                        } else {
                            this.tempOption = 'Ice';
                        }
                        this.showItemModal = true;
                    },

                    calculateItemPrice() {
                        if (!this.selectedItem) return 0;
                        let price = (this.tempOption === 'Ice' && this.selectedItem.price_ice > 0) ?
                            this.selectedItem.price_ice :
                            this.selectedItem.price_hot;
                        return price * this.qty;
                    },

                    addToCartFromModal() {
                        let price = (this.tempOption === 'Ice' && this.selectedItem.price_ice > 0) ?
                            this.selectedItem.price_ice :
                            this.selectedItem.price_hot;

                        const option = ['Snack', 'Dessert'].includes(this.selectedItem.category) ? '' : this.tempOption;

                        const sugar = (['Coffee', 'Non-Coffee', 'Tea', 'Juice'].includes(this.selectedItem.category) &&
                                this.selectedItem.name !== 'Espresso' &&
                                this.selectedItem.name !== 'Mineral Water') ?
                            this.sugarLevel : '';

                        let exist = this.cart.find(i => i.id === this.selectedItem.id && i.option === option && i.sugar ===
                            sugar);

                        if (exist) {
                            exist.qty += this.qty;
                        } else {
                            this.cart.push({
                                id: this.selectedItem.id,
                                name: this.selectedItem.name,
                                price: price,
                                qty: this.qty,
                                option: option,
                                sugar: sugar,
                                category: this.selectedItem.category
                            });
                        }
                        this.showItemModal = false;
                    },

                    increaseQty(index) {
                        this.cart[index].qty++
                    },
                    decreaseQty(index) {
                        if (this.cart[index].qty > 1) {
                            this.cart[index].qty--
                        } else {
                            this.cart.splice(index, 1)
                        }
                    },
                    totalPrice() {
                        return this.cart.reduce((sum, i) => sum + (i.price * i.qty), 0);
                    },
                    formatOptionSugar(option, sugar, name) {
                        let parts = [];
                        const isBasic = name === 'Mineral Water' || name.toLowerCase().includes('juice');
                        if (option && (isBasic || option !== 'Normal')) parts.push(option);
                        if (sugar) parts.push(sugar);
                        return parts.join(' • ');
                    }
                }
            }
        </script>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('print_id')): ?>
        <div x-data="{ open: true }" x-show="open"
            class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">

            <div
                class="bg-white w-full max-w-sm rounded-[2.5rem] p-6 text-center shadow-2xl transform transition-all flex flex-col items-center">

                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>

                <h3 class="text-lg font-black text-gray-800 mb-1">Pesanan Berhasil!</h3>
                <p class="text-[11px] text-gray-400 uppercase tracking-widest mb-4">Pratinjau Nota Pesanan</p>

                <div class="w-full bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 overflow-hidden mb-6"
                    style="height: 300px;">
                    <iframe id="receiptFrame" src="<?php echo e(route('order.print', session('print_id'))); ?>"
                        class="w-full h-full border-none shadow-inner"></iframe>
                </div>

                <div class="flex flex-col w-full gap-2">
                    <button @click="document.getElementById('receiptFrame').contentWindow.print();"
                        class="w-full bg-orange-600 text-white py-3.5 rounded-2xl font-black text-xs flex items-center justify-center gap-3 shadow-xl shadow-orange-600/30 hover:bg-orange-700 transition-all active:scale-95 uppercase tracking-widest">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                            </path>
                        </svg>
                        Cetak Nota Sekarang
                    </button>

                    <button @click="open = false"
                        class="w-full bg-gray-100 text-gray-500 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-gray-200 transition-all">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/cashier/pos/order.blade.php ENDPATH**/ ?>