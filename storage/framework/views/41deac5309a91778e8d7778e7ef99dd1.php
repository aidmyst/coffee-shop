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

    <div class="py-12 flex justify-center">
        <div class="max-w-md w-full bg-white p-8 rounded-3xl shadow-lg border border-gray-100 text-center">
            
            <h1 class="text-[24px] font-black text-orange-600 tracking-tight mb-2">Solstice Cafe</h1>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mb-8">Scan untuk Pesan & Lihat Menu
            </p>

            
            <div class="flex justify-center mb-8 p-4 bg-white rounded-2xl shadow-inner border border-gray-50">
                
                <?php echo QrCode::size(200)->color(31, 41, 55)->backgroundColor(255, 255, 255)->generate('https://linktr.ee/Solstice_Cafe'); ?>

            </div>

            
            <div class="space-y-2">
                <p class="text-sm font-black text-gray-800 uppercase">Langkah Pesan:</p>
                <p class="text-[11px] text-gray-500 font-medium">1. Scan QR di atas<br>2. Klik tombol 'Pesan Di
                    Sini'<br>3. Pilih nomor meja Anda</p>
            </div>

            
            <p class="mt-8 text-[10px] text-gray-300 font-mono break-all uppercase tracking-tighter">
                linktr.ee/Solstice_Cafe
            </p>
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
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/admin/tables/kode_qr.blade.php ENDPATH**/ ?>