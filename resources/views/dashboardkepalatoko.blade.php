<?php
    // Inisialisasi variabel default
    $low_stock_count = $low_stock_count ?? 5;
    
    $low_stock_items = $low_stock_items ?? [
        ['name' => 'Kopi Arabika 250g', 'status' => 'CRITICAL'],
        ['name' => 'Susu UHT 1L', 'status' => 'WARNING'],
    ];

    $sales_trend = $sales_trend ?? [
        'Mon' => 400, 'Tue' => 550, 'Wed' => 450, 
        'Thu' => 600, 'Fri' => 750, 'Sat' => 800, 'Sun' => 700
    ];

    $live_operations = $live_operations ?? [
        ['user' => 'Kasir 1', 'action' => 'Transaksi Baru #1024', 'status' => 'Selesai', 'status_color' => 'bg-emerald-100 text-emerald-700'],
        ['user' => 'Gudang', 'action' => 'Restok Susu UHT', 'status' => 'Pending', 'status_color' => 'bg-amber-100 text-amber-700'],
    ];
    
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Ops - Q-CIS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center p-0 md:p-4">

    <!-- Mobile Frame Container -->
    <div class="w-full max-w-sm bg-slate-50 min-h-screen md:min-h-[750px] md:max-h-[850px] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-between overflow-hidden">
        
        <!-- Header Top -->
        <div class="bg-white px-4 py-3 border-b border-slate-100 flex items-center justify-between sticky top-0 z-10">
            <div class="flex items-center gap-2">
                <button class="text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="font-bold text-slate-800 text-base">Store Ops</span>
            </div>
            <div class="flex items-center gap-1.5 text-emerald-800 font-bold text-sm">
                <svg class="w-5 h-5 fill-emerald-800" viewBox="0 0 24 24">
                    <path d="M19 6h-2c0-2.21-1.79-4-4-4S9 3.79 9 6H7c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6-2c1.1 0 2 .9 2 2h-4c0-1.1.9-2 2-2zm0 10c-1.66 0-3-1.34-3-3h2c0 .55.45 1 1 1s1-.45 1-1h2c0 1.66-1.34 3-3 3z"/>
                </svg>
                <span>Q-CIS</span>
            </div>
        </div>

        <!-- Scrollable Body Content -->
        <div class="p-4 space-y-4 overflow-y-auto pb-24">
            
            <!-- Card Stok Kritis (Menyatu dengan Notifikasi Angka) -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-3 border-b border-slate-50 pb-2">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-sm">
                            {{ $low_stock_count }}
                        </div>
                        <div>
                            <h2 class="text-xs font-bold text-slate-800">Stok Perlu Perhatian</h2>
                            <p class="text-[10px] text-slate-400">Barang mencapai batas minimum</p>
                        </div>
                    </div>
                    <span class="text-[10px] bg-red-50 text-red-600 font-semibold px-2 py-0.5 rounded-full">Kritis</span>
                </div>

                <!-- List Item Stok -->
                <div class="space-y-2">
                    @foreach ($low_stock_items as $item)
                        <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-50 last:border-0">
                            <span class="font-medium text-slate-700">{{ $item['name'] }}</span>
                            <span class="text-[9px] font-bold px-2 py-0.5 rounded {{ $item['status'] === 'CRITICAL' ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600' }}">
                                {{ $item['status'] }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <a href="{{ route('kepalatoko.stock') }}" class="block text-center text-xs font-semibold text-emerald-700 mt-3 hover:underline">
                    Lihat Semua {{ $low_stock_count }} Item &rsaquo;
                </a>
            </div>

            <!-- Sales Trend Card -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xs font-bold text-slate-800">Sales Trend (Last 7 Days)</h3>
                    <div class="flex bg-slate-100 p-0.5 rounded-lg text-[10px]">
                        <button class="bg-emerald-800 text-white px-2 py-0.5 rounded-md font-medium">Count Data</button>
                        <button class="text-slate-500 px-2 py-0.5 font-medium">Earnings</button>
                    </div>
                </div>

                <!-- Grafik Bar Sales -->
                <div class="flex items-end justify-between h-28 pt-4 px-1">
                    @foreach ($sales_trend as $day => $value)
                        @php $heightInPx = ($value / 800) * 80; @endphp
                        <div class="flex flex-col items-center gap-1 w-full">
                            <div class="w-5 bg-emerald-500 rounded-t-sm transition-all duration-300" style="height: {{ $heightInPx }}px;"></div>
                            <span class="text-[9px] text-slate-400 font-medium">{{ $day }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Live Operations Card -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xs font-bold text-slate-800">Live Operations</h3>
                    <a href="#" class="text-[10px] text-emerald-700 font-semibold hover:underline">View All Logs</a>
                </div>

                <div class="space-y-3">
                    @foreach ($live_operations as $op)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center font-bold text-xs text-slate-600">
                                    {{ substr($op['user'], 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-700 leading-tight">{{ $op['user'] }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $op['action'] }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $op['status_color'] }}">
                                {{ $op['status'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Bottom Navigation Bar (Posisi Di Bawah Frame) -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-3 py-2 flex items-center justify-around z-20">
            <!-- Dashboard / Home -->
            <a href="{{ route('kepalatoko.home') }}" class="flex flex-col items-center gap-0.5 text-emerald-500">
                <div class="p-1 rounded-xl bg-emerald-100/70 text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[9px] font-semibold text-emerald-600">Dashboard</span>
            </a>

            <!-- Stock -->
            <a href="{{ route('kepalatoko.stock') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-emerald-600 transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-[9px] font-medium text-slate-500">Stock</span>
            </a>

            <!-- Report -->
            <a href="{{ route('kepalatoko.orders') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-emerald-600 transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[9px] font-medium text-slate-500">Report</span>
            </a>

            <!-- Staff -->
            <a href="{{ route('profile.index') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-emerald-600 transition">
               <div class="p-1">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                  </svg>
                </div>
             <span class="text-[9px] font-medium text-slate-500">Profile</span>
          </a>
        </div>

    </div>

</body>
</html>