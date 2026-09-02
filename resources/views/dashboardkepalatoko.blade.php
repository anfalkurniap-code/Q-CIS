<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Analisis - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <p class="text-xs text-slate-500 mt-0.5">Ringkasan performa penjualan dan transaksi hari ini.</p>
            </div>

            <!-- Tombol Filter & Unduh -->
            <div class="flex items-center gap-2 pt-1">
                <button class="flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 shadow-sm">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Hari Ini</span>
                </button>

                <a href="#" class="flex items-center gap-1.5 px-3 py-1.5 bg-[#064e3b] rounded-lg text-xs font-semibold text-white shadow-sm hover:bg-[#04382a] transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    <span>Unduh Laporan</span>
                </a>
            </div>
        </div>

        <!-- Scrollable Cards Body -->
        <div class="px-4 pb-20 space-y-3 overflow-y-auto">
            
            <!-- Card 1: Uang Masuk -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">UANG MASUK</span>
                    <h2 class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($uang_masuk ?? 5120000, 0, ',', '.') }}</h2>
                    <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-1">
                        <span>🔄</span> Total hari ini
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
                    <h2 class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($uang_keluar ?? 850000, 0, ',', '.') }}</h2>
                    <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-1">
                        <span>🔄</span> Total hari ini
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
                    <h2 class="text-xl font-bold text-slate-900 mt-1">Rp {{ number_format($laba_rugi ?? 4270000, 0, ',', '.') }}</h2>
                    <p class="text-[10px] text-slate-400 flex items-center gap-1 mt-1">
                        <span>📈</span> Laba bersih hari ini
                    </p>
                </div>
                <div class="w-9 h-9 rounded-full bg-teal-100/70 flex items-center justify-center text-teal-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>

            <!-- Card 4: Grafik Penjualan Harian -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-bold text-slate-900">Grafik Penjualan Harian</h3>
                    <button class="text-slate-400 hover:text-slate-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                    </button>
                </div>

                <!-- Area Grafik Placeholder -->
                <div class="w-full h-44 bg-slate-100 border-2 border-dashed border-slate-200 rounded-xl flex flex-col items-center justify-center p-4 text-center">
                    <svg class="w-8 h-8 text-slate-400 mb-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 19h14v2H3V3h2v16zm4-8h2v6H9v-6zm4-4h2v10h-2V7zm4-2h2v12h-2V5z"/>
                    </svg>
                    <span class="text-[11px] text-slate-500 font-medium">
                        Area Grafik Penjualan (Integrasi Chart.js/bs)
                    </span>
                </div>
            </div>

        </div>

        <!-- Bottom Navbar -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-6 py-2 flex items-center justify-around z-20">
            <!-- Dashboard (Active) -->
            <a href="#" class="flex flex-col items-center gap-1 text-[#064e3b]">
                <div class="px-4 py-1.5 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Dashboard</span>
            </a>

            <!-- Reports -->
            <a href="#" class="flex flex-col items-center gap-1 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Reports</span>
            </a>

            <!-- Profile -->
            <a href="#" class="flex flex-col items-center gap-1 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Profile</span>
            </a>
        </div>

    </div>

</body>
</html>