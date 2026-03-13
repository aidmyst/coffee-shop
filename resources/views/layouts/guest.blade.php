<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Solstice Cafe') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    {{-- 
            Kita hapus semua div pembungkus yang memberikan background abu-abu 
            dan logo Laravel agar login.blade.php bisa mengontrol tampilannya sendiri.
        --}}
    <div class="min-h-screen">
        {{ $slot }}
    </div>
</body>

</html>
