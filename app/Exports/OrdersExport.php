<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithStyles, WithEvents
{
    protected $date;
    protected $mergeData = []; // Untuk menyimpan info baris mana saja yang perlu di-merge

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $query = Order::query();
        if ($this->date) {
            $query->whereDate('created_at', $this->date);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();
        $rows = collect();
        $currentRow = 2; // Data dimulai dari baris 2 (baris 1 adalah heading)

        foreach ($orders as $order) {
            $items = json_decode($order->items);
            $itemCount = count($items);

            // Simpan informasi baris untuk proses merge nanti
            if ($itemCount > 1) {
                $this->mergeData[] = [
                    'start' => $currentRow,
                    'end' => $currentRow + $itemCount - 1
                ];
            }

            foreach ($items as $item) {
                $rows->push([
                    'tanggal'      => $order->created_at->format('d/m/Y'),
                    'waktu'        => $order->created_at->format('H:i'),
                    'meja'         => $order->table_number,
                    'nama_menu'    => $item->name,
                    'qty'          => $item->qty,
                    'opsi'         => (isset($item->option) ? $item->option : '') .
                        (isset($item->option) && isset($item->sugar) ? ' • ' : '') .
                        (isset($item->sugar) ? $item->sugar : ''),
                    'catatan'      => $order->note ?? '-',
                    'total_bayar'  => $order->total_price,
                    'status'       => ucfirst($order->status),
                ]);
            }
            $currentRow += $itemCount;
        }

        return $rows;
    }

    public function headings(): array
    {
        return ['Tanggal', 'Waktu', 'Meja', 'Nama Menu', 'Qty', 'Varian/Sugar', 'Catatan Order', 'Total Bayar (Struk)', 'Status'];
    }

    public function map($row): array
    {
        return [
            $row['tanggal'],
            $row['waktu'],
            $row['meja'],
            $row['nama_menu'],
            $row['qty'],
            $row['opsi'] ?: '-',
            $row['catatan'],
            $row['total_bayar'],
            $row['status']
        ];
    }

    public function columnFormats(): array
    {
        return ['H' => '"Rp "#,##0'];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Logika Merging Baris
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestRow = $sheet->getHighestRow();
                $fullRange = "A1:I{$highestRow}"; // Mulai dari baris 1 (Header)

                // 1. Set SEMUA sel (termasuk Header) agar Vertical Center
                $sheet->getStyle($fullRange)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // 2. STYLING KHUSUS HEADER (Baris 1)
                // Buat rata tengah semua (Horizontal & Vertical) dan Bold
                $sheet->getStyle('A1:I1')->getAlignment()->applyFromArray([
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ]);
                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                // 3. SETTING HORIZONTAL ALIGNMENT UNTUK DATA (Baris 2 dst)
                // Kolom Tengah: Tanggal(A), Waktu(B), Meja(C), Qty(E), Catatan(G), Total(H), Status(I)
                $centerColumns = ['A', 'B', 'C', 'E', 'G', 'H', 'I'];
                foreach ($centerColumns as $col) {
                    $sheet->getStyle("{$col}2:{$col}{$highestRow}")
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // Kolom Kiri: Nama Menu (D) dan Varian (F)
                $leftColumns = ['D', 'F'];
                foreach ($leftColumns as $col) {
                    $sheet->getStyle("{$col}2:{$col}{$highestRow}")
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_LEFT);
                }

                // 4. Aktifkan Wrap Text untuk Catatan
                $sheet->getStyle("G2:G{$highestRow}")->getAlignment()->setWrapText(true);

                // 5. Jalankan Merging untuk data transaksi yang itemnya > 1
                foreach ($this->mergeData as $m) {
                    $columnsToMerge = ['A', 'B', 'C', 'G', 'H', 'I'];
                    foreach ($columnsToMerge as $col) {
                        $sheet->mergeCells("{$col}{$m['start']}:{$col}{$m['end']}");
                    }
                }

                // 6. Auto-size kolom agar lebar box pas
                foreach (range('A', 'I') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
