<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Solstice Cafe - Menu</title>

    <script src="https://cdn.tailwindcss.com"></script>

    
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
    
    <audio id="notif-sound" src="<?php echo e(asset('sounds/notification.mp3')); ?>" preload="auto"></audio>

    <?php echo e($slot); ?>

</body>

</html>
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/components/public-layout.blade.php ENDPATH**/ ?>