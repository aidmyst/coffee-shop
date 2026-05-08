<x-app-layout>
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 mb-6">
        <div class="bg-white shadow-sm rounded-xl py-4 px-6 flex flex-wrap justify-between items-center gap-4 mt-6">
            <div>
                <h3 class="font-black text-lg text-gray-800 uppercase tracking-tighter">Data Penjualan Cafe</h3>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Laporan & Statistik</p>
            </div>

            <div class="flex items-center gap-3">
                {{-- Tombol Buka Google Sheets --}}
                <a href="https://docs.google.com/spreadsheets/d/16gM-qaIxb0MSKjBKRSDhuXJ5WjTbPUK5MpRAWZSVZEw/edit"
                    target="_blank" title="Buka Google Sheets"
                    class="flex items-center gap-2 text-xs font-bold text-white bg-emerald-500 hover:bg-emerald-600 px-4 py-2 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span>Spreadsheet</span>
                </a>

                {{-- Form Download Harian --}}
                <form action="{{ route('admin.export.daily') }}" method="GET" class="flex items-center gap-2">
                    <button type="submit" title="Download Sesuai Tanggal"
                        class="flex items-center gap-2 text-xs font-bold text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span>Excel (Harian)</span>
                    </button>
                </form>

                {{-- Tombol Download SEMUA --}}
                <a href="{{ route('admin.export.all') }}" title="Download Semua Data"
                    class="flex items-center gap-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span>Excel (Semua)</span>
                </a>
            </div>
        </div>
    </div>

    <div>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Kiri: Statistik Pendapatan --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Statistik Pendapatan</h2>
                        <p class="text-sm text-gray-500 font-bold">Grafik total penjualan 30 hari terakhir</p>
                    </div>

                    <div class="relative h-[400px]">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>

                {{-- Kanan: Statistik Menu Terbanyak --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Menu Terpopuler</h2>
                        <p class="text-sm text-gray-500 font-bold">Menu yang paling banyak dipesan</p>
                    </div>

                    <div class="relative h-[400px] flex items-center justify-center">
                        <canvas id="menuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- BAGIAN ANALISIS PROFIT (NEW) --}}
    {{-- ========================================== --}}
    @php
        // Kalkulasi Dasar dari data $totals yang sudah ada
        $grandTotalRevenue = $totals->sum();

        // Estimasi Biaya Bahan Baku (HPP) - Standar Cafe sekitar 40% - 45%
        $cogsPercentage = 0.45;
        $estimatedCogs = $grandTotalRevenue * $cogsPercentage;

        // Laba Bersih (Kotor)
        $estimatedProfit = $grandTotalRevenue - $estimatedCogs;

        // Margin Keuntungan
        $profitMargin = $grandTotalRevenue > 0 ? ($estimatedProfit / $grandTotalRevenue) * 100 : 0;
    @endphp

    <div>
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 mt-6 mb-8">
            <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-100">
                <div class="flex justify-between items-end mb-6 border-b pb-4">
                    <div>
                        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight flex items-center gap-2">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Analisis Profitabilitas
                        </h2>
                        <p class="text-sm text-gray-500 font-bold mt-1">Estimasi margin keuntungan berdasarkan data
                            penjualan 30 hari terakhir</p>
                    </div>
                    <span
                        class="px-3 py-1 bg-gray-100 text-gray-500 text-[10px] font-black uppercase tracking-widest rounded-lg">30
                        Hari Terakhir</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Card 1: Total Pendapatan --}}
                    <div class="bg-blue-50/50 border border-blue-100 p-4 rounded-xl relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                            <svg class="w-20 h-20 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd"
                                    d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-[10px] text-blue-600 font-black uppercase tracking-widest relative z-10">
                            Pendapatan Kotor</p>
                        <h3 class="text-2xl font-black text-blue-900 mt-1 relative z-10">Rp
                            {{ number_format($grandTotalRevenue, 0, ',', '.') }}</h3>
                    </div>

                    {{-- Card 2: Biaya Pokok (HPP) --}}
                    <div class="bg-red-50/50 border border-red-100 p-4 rounded-xl relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                            <svg class="w-20 h-20 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-[10px] text-red-600 font-black uppercase tracking-widest relative z-10">Biaya
                            Bahan (HPP) ~45%</p>
                        <h3 class="text-2xl font-black text-red-900 mt-1 relative z-10">Rp
                            {{ number_format($estimatedCogs, 0, ',', '.') }}</h3>
                    </div>

                    {{-- Card 3: Laba Bersih --}}
                    <div
                        class="bg-emerald-50/50 border border-emerald-100 p-4 rounded-xl relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 opacity-10 group-hover:scale-110 transition-transform">
                            <svg class="w-20 h-20 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-[10px] text-emerald-600 font-black uppercase tracking-widest relative z-10">
                            Estimasi Laba Bersih</p>
                        <h3 class="text-2xl font-black text-emerald-900 mt-1 relative z-10">Rp
                            {{ number_format($estimatedProfit, 0, ',', '.') }}</h3>
                    </div>

                    {{-- Card 4: Margin % --}}
                    <div
                        class="bg-indigo-50/50 border border-indigo-100 p-4 rounded-xl relative overflow-hidden group flex flex-col justify-center items-center text-center">
                        <p class="text-[10px] text-indigo-600 font-black uppercase tracking-widest relative z-10 mb-1">
                            Margin Profit</p>
                        <div class="flex items-center gap-1">
                            <h3 class="text-3xl font-black text-indigo-900 relative z-10">
                                {{ number_format($profitMargin, 1, ',', '.') }}%</h3>
                        </div>
                    </div>
                </div>

                {{-- Catatan Kecil Keterangan Estimasi --}}
                <div
                    class="mt-4 flex items-start gap-2 bg-yellow-50 text-yellow-700 p-3 rounded-lg border border-yellow-100">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-[10px] font-bold leading-tight">
                        <strong>Catatan:</strong> Data Harga Pokok Penjualan (HPP) dan Laba Bersih di atas merupakan
                        kalkulasi estimasi standar industri cafe (Biaya bahan 45%). Untuk mendapatkan laporan laba riil,
                        sistem perlu diintegrasikan dengan modul harga beli bahan baku pada fitur Inventaris.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Batang Pendapatan
        let orderChartRendered = false; // 1. Variabel penanda awal

        const ctxOrder = document.getElementById('orderChart').getContext('2d');
        new Chart(ctxOrder, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Total Pendapatan (Rp)',
                    data: {!! json_encode($totals) !!},
                    backgroundColor: 'rgba(249, 115, 22, 0.2)',
                    borderColor: 'rgba(249, 115, 22, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                // transitions resize bisa dihapus saja
                animation: {
                    duration: 1000,
                    easing: 'linear',
                    onComplete: function() {
                        // 2. Saat animasi pertama selesai, ubah status jadi true
                        orderChartRendered = true;
                    }
                },
                animations: {
                    y: {
                        // 3. Jika sudah render, matikan durasi, from, dan delay
                        duration: () => orderChartRendered ? 0 : 500,
                        easing: 'linear',
                        from: (ctx) => orderChartRendered ? undefined : ctx.chart.scales.y.getPixelForValue(0),
                        delay: (context) => {
                            if (!orderChartRendered && context.type === 'data' && context.mode === 'default') {
                                return context.dataIndex * 50;
                            }
                            return 0;
                        }
                    },
                    x: {
                        duration: 0
                    },
                    numbers: {
                        duration: 0
                    },
                    colors: {
                        duration: 0
                    },
                    initial: {
                        duration: 0
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            maxRotation: 45,
                            minRotation: 45
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Chart Diagram Menu Terpopuler
        const ctxMenu = document.getElementById('menuChart').getContext('2d');

        const menuData = {!! json_encode($menuTotals) !!};
        const totalMenu = menuData.reduce((a, b) => a + b, 0);

        new Chart(ctxMenu, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($menuLabels) !!},
                datasets: [{
                    data: menuData,
                    backgroundColor: ['#f97316', '#fb923c', '#facc15', '#84cc16', '#22d3ee', '#3b82f6',
                        '#8b5cf6', '#ec4899'
                    ],
                    borderWidth: 1,
                }]
            },
            options: {
                animation: {
                    duration: 500,
                    easing: 'linear',
                    animateRotate: true,
                    animateScale: false // Wajib false agar tidak tumbuh dari tengah
                },
                // Tambahan untuk memastikan ukuran langsung fix
                animations: {
                    numbers: {
                        properties: ['circumference', 'endAngle', 'startAngle'], // Hanya animasikan putaran
                        type: 'number'
                    },
                    colors: false,
                    // Matikan animasi pada radius agar tidak mekar
                    radius: {
                        duration: 0
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let value = context.raw;
                                let percentage = ((value / totalMenu) * 100).toFixed(1);
                                return context.label + ': ' + percentage + '% (' + value + ' pesanan)';
                            }
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
