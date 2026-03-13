<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- TAMBAHKAN INI: Ini yang bikin error submitOrder tadi --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Solstice Cafe - Menu</title>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- URUTAN PENTING: Plugin Collapse harus sebelum Alpine Core --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        html {
            scroll-padding-top: 85px;
            scroll-behavior: smooth;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    {{-- Audio ditaruh di sini agar global dan tidak hilang --}}
    <audio id="notif-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

    {{ $slot }}
</body>

</html>
