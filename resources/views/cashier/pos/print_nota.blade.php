<!DOCTYPE html>
<html>

<head>
    <title>Print Nota #{{ $order->id }}</title>
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
        {{ $order->created_at->format('d/m/Y H:i') }}
    </div>

    <div class="border-bottom"></div>
    <div>
        Pelanggan: {{ $order->customer_name }}<br>
        Tipe: {{ $order->table_number }}
    </div>
    <div class="border-bottom"></div>

    <table>
        @foreach (json_decode($order->items) as $item)
            <tr>
                <td colspan="3">{{ $item->name }}</td>
            </tr>
            <tr>
                <td class="qty">{{ $item->qty }}x</td>
                <td style="font-size: 10px; color: #555;">{{ $item->option }} {{ $item->sugar }}</td>
                <td class="price">{{ number_format($item->price * $item->qty, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="border-bottom"></div>
    <table>
        <tr>
            <td><strong>TOTAL</strong></td>
            <td class="price"><strong>{{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <div class="border-bottom"></div>
    <div class="text-center footer">
        Terima kasih atas kunjungannya!<br>
        Instagram: @solstice.cafe
    </div>
</body>

</html>
