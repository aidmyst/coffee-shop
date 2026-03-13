<!DOCTYPE html>
<html>

<head>
    <title>Print Nota #<?php echo e($order->id); ?></title>
    <style>
        /* CSS Normal untuk tampilan di Layar Browser */
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 20px auto;
            /* Membuat nota berada di tengah layar */
            width: 58mm;
            padding: 5mm;
            font-size: 12px;
            line-height: 1.2;
            border: 1px solid #eee;
            /* Garis tipis pembantu di layar */
            background: white;
        }

        .text-center {
            text-align: center;
        }

        .border-bottom {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .qty {
            width: 10%;
        }

        .price {
            text-align: right;
        }

        .footer {
            margin-top: 10px;
            font-size: 10px;
        }

        /* CSS KHUSUS SAAT DICETAK (PRINTER) */
        @media print {
            @page {
                size: 58mm auto;
                margin: 0;
            }

            body {
                margin: 0;
                border: none;
                width: 58mm;
            }
        }
    </style>
</head>

<body class="bg-white">
    <div class="text-center">
        <strong style="font-size: 14px;">SOLSTICE CAFE</strong><br>
        Jl. Raya Cidahu No. 32, Kec. Cicurug Kabupaten Sukabumi<br>
        <?php echo e($order->created_at->format('d/m/Y H:i')); ?>

    </div>

    <div class="border-bottom"></div>
    <div>
        Pelanggan: <?php echo e($order->customer_name); ?><br>
        Tipe: <?php echo e($order->table_number); ?>

    </div>
    <div class="border-bottom"></div>

    <table>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = json_decode($order->items); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <tr>
                <td colspan="3"><?php echo e($item->name); ?></td>
            </tr>
            <tr>
                <td class="qty"><?php echo e($item->qty); ?>x</td>
                <td style="font-size: 10px; color: #555;"><?php echo e($item->option); ?> <?php echo e($item->sugar); ?></td>
                <td class="price"><?php echo e(number_format($item->price * $item->qty, 0, ',', '.')); ?></td>
            </tr>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </table>

    <div class="border-bottom"></div>
    <table>
        <tr>
            <td><strong>TOTAL</strong></td>
            <td class="price"><strong><?php echo e(number_format($order->total_price, 0, ',', '.')); ?></strong></td>
        </tr>
    </table>

    <div class="border-bottom"></div>
    <div class="text-center footer">
        Terima kasih atas kunjungannya!<br>
        Instagram: @solstice.cafe
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/cashier/pos/print_nota.blade.php ENDPATH**/ ?>