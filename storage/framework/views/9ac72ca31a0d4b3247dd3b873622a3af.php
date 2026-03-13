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

    <div class="max-w-full mx-auto sm:px-6 lg:px-8 mb-6">
        <div class="bg-white shadow-sm rounded-xl py-4 px-6 flex flex-wrap justify-between items-center gap-4 mt-6">
            <div>
                <h3 class="font-black text-lg text-gray-800 uppercase tracking-tighter">Pantauan Aktivitas Cafe</h3>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Laporan & Statistik</p>
            </div>

            <div class="flex items-center gap-3">
                
                <a href="https://docs.google.com/spreadsheets/d/16gM-qaIxb0MSKjBKRSDhuXJ5WjTbPUK5MpRAWZSVZEw/edit"
                    target="_blank" title="Buka Google Sheets"
                    class="flex items-center gap-2 text-xs font-bold text-white bg-emerald-500 hover:bg-emerald-600 px-4 py-2 rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2zM14 8V3.5L18.5 8H14z" />
                    </svg>
                    <span>Spreadsheet (Semua)</span>
                </a>

                
                <form action="<?php echo e(route('admin.export.daily')); ?>" method="GET" class="flex items-center gap-2">
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

                
                <a href="<?php echo e(route('admin.export.all')); ?>" title="Download Semua Data"
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-black text-gray-800 uppercase tracking-tight">Statistik Pendapatan</h2>
                        <p class="text-sm text-gray-500 font-bold">Grafik total penjualan 30 hari terakhir</p>
                    </div>

                    <div class="relative h-[400px]">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>

                
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

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Batang Pendapatan
        const ctxOrder = document.getElementById('orderChart').getContext('2d');
        new Chart(ctxOrder, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Total Pendapatan (Rp)',
                    data: <?php echo json_encode($totals); ?>,
                    backgroundColor: 'rgba(249, 115, 22, 0.2)',
                    borderColor: 'rgba(249, 115, 22, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                animation: {
                    duration: 1000,
                    easing: 'linear',
                },
                animations: {
                    y: {
                        duration: 500, // Dipercepat sedikit karena batangnya banyak
                        easing: 'linear',
                        from: (ctx) => ctx.chart.scales.y.getPixelForValue(0),
                        delay: (context) => {
                            if (context.type === 'data' && context.mode === 'default') {
                                // Delay diperkecil agar tidak kelamaan nunggu 30 batang muncul
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
                            display: false // Hilangkan garis vertikal agar lebih bersih
                        },
                        ticks: {
                            maxRotation: 45, // Miringkan label jika terlalu rapat
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

        const menuData = <?php echo json_encode($menuTotals); ?>;
        const totalMenu = menuData.reduce((a, b) => a + b, 0);

        new Chart(ctxMenu, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($menuLabels); ?>,
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
<?php /**PATH C:\laragon\www\coffee-shop\resources\views/admin/report/statistic.blade.php ENDPATH**/ ?>