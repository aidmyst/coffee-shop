<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body x-cloak class="font-sans antialiased" x-data="{
    sidebarOpen: localStorage.getItem('sidebarStatus') !== 'collapsed',
    toggleSidebar() {
        this.sidebarOpen = !this.sidebarOpen;
        localStorage.setItem('sidebarStatus', this.sidebarOpen ? 'expanded' : 'collapsed');
    }
}" x-init="$nextTick(() => $el.removeAttribute('x-cloak'))">
    <div class="min-h-screen bg-gray-100 flex">

        {{-- Navigation / Sidebar --}}
        @include('layouts.navigation')

        <div class="flex-1 flex flex-col min-w-0">

            {{-- Page Header --}}
            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Slot Konten --}}
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <audio id="global-notif-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

    @livewireScripts

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
