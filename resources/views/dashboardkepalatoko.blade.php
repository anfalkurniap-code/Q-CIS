<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analisis - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Library Chart.js untuk grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center p-0 md:p-4">

    <!-- Container Frame HP -->
    <div class="w-full max-w-sm bg-[#f8faf9] min-h-screen md:min-h-[750px] md:max-h-[850px] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-between overflow-hidden">
        
        <!-- Header Top -->
        <div class="p-4 space-y-3">
            <div class="flex items-center gap-2 text-[#064e3b] font-bold text-sm">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Q-CIS SMK MART</span>
            </div>

            <div>
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">Dashboard Analisis</h1>
                <p class="text-xs text-slate-500 mt-0.5">Ringkasan performa penjualan dan transaksi.</p>
            </div>

            <!-- Form Filter Tanggal & Preset -->
            <form id="filterForm" action="{{ route('dashboard.kepalatoko') }}" method="GET" class="space-y-2">
                <div class="flex items-center gap-2 pt-1">
                    <!-- Dropdown Select Filter Preset -->
                    <div class="relative flex-1">
                        <select name="filter_type" id="filterTypeSelect" onchange="toggleCustomDateInputs(this.value)" class="w-full appearance-none bg-white border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 py-2 pl-3 pr-8 shadow-sm focus:outline-none focus:ring-2 focus:ring-[#064e3b] cursor-pointer">
                            <option value="today" {{ ($filter_type ?? 'today') == 'today' ? 'selected' : '' }}>📅 Hari Ini</option>
                            <option value="7days" {{ ($filter_type ?? '') == '7days' ? 'selected' : '' }}>🗓️ 7 Hari Terakhir</option>
                            <option value="30days" {{ ($filter_type ?? '') == '30days' ? 'selected' : '' }}>📊 30 Hari Terakhir</option>
                            <option value="all" {{ ($filter_type ?? '') == 'all' ? 'selected' : '' }}>🌐 Semua Waktu (Total Keseluruhan)</option>
                            <option value="custom" {{ ($filter_type ?? '') == 'custom' ? 'selected' : '' }}>🔍 Rentang Tanggal Custom...</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>

                    @if(($filter_type ?? 'today') !== 'today')
                        <a href="{{ route('dashboard.kepalatoko') }}" class="px-2.5 py-2 bg-slate-100 border border-slate-200 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-200 transition" title="Reset Filter">
                            Reset
                        </a>
                    @endif
                </div>

                <!-- Input Rentang Tanggal Custom (Hanya Tampil Jika Custom Dipilih) -->
                <div id="customDateContainer" class="{{ ($filter_type ?? '') == 'custom' ? 'block' : 'hidden' }} bg-white p-3 rounded-xl border border-slate-200 shadow-sm text-xs space-y-2">
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Mulai</label>
                            <input type="date" name="start_date" value="{{ $start_date ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-1.5 text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-[#064e3b]">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-slate-400 mb-1">Selesai</label>
                            <input type="date" name="end_date" value="{{ $end_date ?? '' }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-1.5 text-xs text-slate-700 focus:outline-none focus:ring-1 focus:ring-[#064e3b]">
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-[#064e3b] text-white py-1.5 rounded-lg text-xs font-bold hover:bg-[#04382a] transition shadow-sm">
                        Terapkan Tanggal
                    </button>
                </div>
            </form>
        </div>

        <!-- Scrollable Cards Body -->
        <div class="px-4 pb-20 space-y-3 overflow-y-auto">

            <!-- Subheader Active Filter Badge -->
            <div class="flex items-center justify-between text-[11px] text-slate-500 font-medium px-1">
                <span>Periode Aktif:</span>
                <span class="font-bold text-[#064e3b] bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-100/60">
                    {{ $filter_label ?? 'Hari Ini' }}
                </span>
            </div>
            
            <!-- Card 1: Uang Masuk -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">UANG MASUK</span>
                    <h2 class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($uang_masuk ?? 0, 0, ',', '.') }}</h2>
                    <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-1">
                        <span>🔄</span> {{ $filter_label ?? 'Total' }}
                    </p>
                </div>
                <div class="w-9 h-9 rounded-full bg-emerald-100/70 flex items-center justify-center text-emerald-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>

            <!-- Card 2: Uang Keluar -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">UANG KELUAR</span>
                    <h2 class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($uang_keluar ?? 0, 0, ',', '.') }}</h2>
                    <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-1">
                        <span>🔄</span> {{ $filter_label ?? 'Total' }}
                    </p>
                </div>
                <div class="w-9 h-9 rounded-full bg-rose-100/70 flex items-center justify-center text-rose-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                </div>
            </div>

            <!-- Card 3: Laba / Rugi -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">LABA / RUGI</span>
                    <h2 class="text-xl font-bold {{ ($laba_rugi ?? 0) < 0 ? 'text-rose-600' : 'text-slate-900' }} mt-1">
                        Rp {{ number_format($laba_rugi ?? 0, 0, ',', '.') }}
                    </h2>
                    <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-1">
                        <span>{{ ($laba_rugi ?? 0) >= 0 ? '📈' : '📉' }}</span> 
                        {{ ($laba_rugi ?? 0) >= 0 ? 'Laba bersih' : 'Rugi' }} ({{ $filter_label ?? 'Total' }})
                    </p>
                </div>
                <div class="w-9 h-9 rounded-full {{ ($laba_rugi ?? 0) >= 0 ? 'bg-teal-100/70 text-teal-800' : 'bg-rose-100/70 text-rose-700' }} flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 4: Grafik Penjualan (Berdasarkan Kuantitas Barang Terjual - Pcs/Unit) -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-3">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Grafik Penjualan</h3>
                        <p class="text-[10px] text-slate-400">Total Kuantitas Barang Terjual (Unit/Pcs)</p>
                    </div>
                </div>

                <!-- Canvas Chart.js Dinamis -->
                <div class="w-full h-44">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

        </div>

        <!-- Bottom Navbar -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-3 py-2 flex items-center justify-around z-20">
            <!-- 1. Dashboard (Aktif) -->
            <a href="{{ route('dashboard.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-[#064e3b]">
                <div class="px-3 py-1 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Dashboard</span>
            </a>

            <!-- 2. Stok Barang -->
            <a href="{{ route('stok.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Stok Barang</span>
            </a>

            <!-- 3. Reports -->
            <a href="{{ route('report.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Reports</span>
            </a>

            <!-- 4. Profile -->
            <a href="{{ route('profile.kepalatoko.index') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Profile</span>
            </a>
        </div>

    </div>

    <script>
        function toggleCustomDateInputs(value) {
            const container = document.getElementById('customDateContainer');
            if (value === 'custom') {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
                document.getElementById('filterForm').submit();
            }
        }

        // Script Chart.js (Grafik Kuantitas Barang Terjual - Pcs/Unit)
        const ctx = document.getElementById('salesChart').getContext('2d');
        const chartLabels = @json($chart_labels ?? []);
        const chartValues = @json($chart_values ?? []);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Barang Terjual (Pcs)',
                    data: chartValues,
                    backgroundColor: '#064e3b',
                    hoverBackgroundColor: '#04382a',
                    borderRadius: 6,
                    borderSkipped: false,
                    barThickness: 16
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' Barang Terjual: ' + context.raw + ' Pcs';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 10, weight: '600' },
                            color: '#64748b'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: { size: 10 },
                            color: '#64748b',
                            precision: 0,
                            callback: function(value) {
                                return value + ' Pcs';
                            }
                        },
                        grid: { color: '#f1f5f9' }
                    }
                }
            }
        });
    </script>
</body>
</html>