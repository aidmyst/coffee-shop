<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        [x-cloak] {
            display: none !important;
        }

        [x-cloak] * {
            transition: none !important;
        }
    </style>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body x-cloak class="font-sans antialiased" x-data="{
    sidebarOpen: localStorage.getItem('sidebarStatus') !== 'collapsed',
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
        localStorage.setItem('sidebarStatus', this.sidebarOpen ? 'expanded' : 'collapsed');
    }
}" x-init="$nextTick(() => $el.removeAttribute('x-cloak'))">
    <div class="min-h-screen bg-gray-100 flex">

        
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="flex-1 flex flex-col min-w-0">

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <main class="p-6">
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>

    <audio id="global-notif-sound" src="<?php echo e(asset('sounds/notification.mp3')); ?>" preload="auto"></audio>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <script>
        // FUNGSI PLAY SUARA (RESUABLE)
        function playNotification() {
            const audio = document.getElementById('global-notif-sound');
            const isAudioEnabled = localStorage.getItem('audio_active') === 'true';

            if (audio && isAudioEnabled) {
                audio.pause();
                audio.currentTime = 0;

                const playPromise = audio.play();

                if (playPromise !== undefined) {
                    playPromise.catch(e => {
                        console.log("Autoplay dicegah browser. Munculkan kembali tombol aktifkan.");
                        localStorage.removeItem('audio_active');
                        if (window.Livewire) {
                            window.dispatchEvent(new CustomEvent('audio-blocked'));
                        }
                    });
                }
            }
        }

        // 1. LISTEN DARI LIVEWIRE
        document.addEventListener('livewire:init', () => {
            Livewire.on('play-notification-sound', () => {
                playNotification();
            });
        });

        // 2. LISTEN DARI FETCH API (Polling Berbasis ID Terakhir)
        let lastOrderId = null;
        let firstLoad = true;

        async function checkOrders() {
            if (localStorage.getItem('audio_active') !== 'true') return;

            try {
                const response = await fetch('/api/check-orders');
                if (!response.ok) return;
                const data = await response.json();

                if (!firstLoad && data.last_id && data.last_id !== lastOrderId) {
                    playNotification();
                }

                lastOrderId = data.last_id;
                firstLoad = false;
            } catch (e) {
                console.error("Check order error:", e);
            }
        }
        setInterval(checkOrders, 5000);

        // 3. UPDATE BADGE PENDING (Menu Sidebar)
        function updatePendingOrders() {
            fetch('/api/pending-orders-count')
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('pendingBadge');
                    if (!badge) return;
                    if (data.count > 0) {
                        badge.innerText = data.count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }).catch(err => console.log("Badge error:", err));
        }
        setInterval(updatePendingOrders, 3000);
        updatePendingOrders();
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/layouts/app.blade.php ENDPATH**/ ?>