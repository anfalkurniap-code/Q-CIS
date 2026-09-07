<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi & Inventaris - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center p-0 md:p-4">

    <!-- Container Frame HP -->
    <div class="w-full max-w-sm bg-[#f8faf9] h-screen md:h-[750px] md:max-h-[850px] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-start overflow-hidden">
        
        <!-- Header & Nav Top (Bagian Atas Tetap) -->
        <div class="p-4 pb-2 space-y-3 bg-[#f8faf9] shrink-0">
            <div class="flex items-center justify-between text-[#064e3b]">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Q-CIS SMK MART</span>
                </div>
                <button class="text-slate-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <!-- Title & Subtitle -->
            <div>
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight leading-tight">Laporan Transaksi & Inventaris</h1>
                <p class="text-xs text-slate-500 mt-0.5">Daftar persetujuan barang masuk dan riwayat transaksi.</p>
            </div>

            <!-- Flash Alert Success / Error -->
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs rounded-xl p-2.5">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-rose-100 border border-rose-300 text-rose-800 text-xs rounded-xl p-2.5">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Search & Date Filter -->
            <form method="GET" action="{{ route('report.kepalatoko') }}" class="space-y-2">
                <input type="hidden" name="tab" value="{{ request('tab', 'masuk') }}">
                
                <!-- Search Input -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang..." class="w-full pl-9 pr-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-700 shadow-sm" onchange="this.form.submit()">
                </div>

                <!-- Date Picker Input -->
                <div class="relative">
                    <input type="date" name="date" value="{{ request('date') }}" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-600 focus:outline-none focus:border-emerald-700 shadow-sm" onchange="this.form.submit()">
                </div>
            </form>

            <!-- Tabs Nav -->
            <div class="flex border-b border-slate-200 text-xs pt-1">
                <a href="{{ route('report.kepalatoko', ['tab' => 'masuk', 'search' => request('search'), 'date' => request('date')]) }}" class="w-1/2 py-2 text-center font-bold {{ request('tab', 'masuk') == 'masuk' ? 'text-[#064e3b] border-b-2 border-[#064e3b]' : 'text-slate-400 hover:text-slate-600' }}">
                    Barang Masuk<br><span class="font-normal text-[11px] {{ request('tab', 'masuk') == 'masuk' ? 'text-slate-500' : 'text-slate-400' }}">(Gudang)</span>
                </a>
                <a href="{{ route('report.kepalatoko', ['tab' => 'keluar', 'search' => request('search'), 'date' => request('date')]) }}" class="w-1/2 py-2 text-center font-semibold {{ request('tab') == 'keluar' ? 'text-[#064e3b] border-b-2 border-[#064e3b]' : 'text-slate-400 hover:text-slate-600' }}">
                    Barang Keluar<br><span class="font-normal text-[11px] {{ request('tab') == 'keluar' ? 'text-slate-500' : 'text-slate-400' }}">(Kasir)</span>
                </a>
            </div>
        </div>

        <!-- Scrollable Item List (Langsung Menempel di Bawah Tab) -->
        <div class="px-4 pt-3 pb-24 space-y-3 overflow-y-auto flex-1">
            
            @forelse($barangMasuk as $item)
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-slate-100 flex items-start justify-between">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 shrink-0 mt-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-900 leading-snug">{{ $item->name ?? $item->nama_barang }}</h3>
                            <div class="flex items-center gap-2 text-[11px] text-slate-500 mt-1">
                                <span><strong class="text-slate-800">{{ $item->stock ?? $item->jumlah }}</strong> Pcs</span>
                                <span>• Rp{{ number_format($item->price ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-1.5 shrink-0">
                        <!-- Waktu Input -->
                        <div class="flex items-center gap-1 text-[10px] text-slate-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($item->created_at)->format('H:i • d M') }}</span>
                        </div>

                        <!-- Status & Tombol Persetujuan -->
                        @if(($item->status ?? 'pending') == 'approved')
                            <span class="text-[9px] font-semibold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-md">
                                Disetujui
                            </span>
                        @elseif(($item->status ?? 'pending') == 'rejected')
                            <span class="text-[9px] font-semibold bg-rose-100 text-rose-800 px-2 py-0.5 rounded-md">
                                Ditolak
                            </span>
                        @else
                            <div class="flex items-center gap-1 mt-1">
                                <form action="{{ route('report.approve', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold px-2 py-1 rounded-md transition shadow-sm">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('report.reject', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-rose-500 hover:bg-rose-600 text-white text-[10px] font-bold px-2 py-1 rounded-md transition shadow-sm">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <!-- Tampilan Jika Data Kosong -->
                <div class="text-center py-10">
                    <p class="text-xs text-slate-400">Tidak ada data transaksi ditemukan.</p>
                </div>
            @endforelse

        </div>

        <!-- Bottom Navigation Bar (Melayang di Bawah) -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-6 py-2 flex items-center justify-around z-20">
            <!-- Dashboard -->
            <a href="{{ route('dashboard.kepalatoko') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Dashboard</span>
            </a>

            <!-- Reports (Aktif) -->
            <a href="{{ route('report.kepalatoko') }}" class="flex flex-col items-center gap-1 text-[#064e3b]">
                <div class="px-4 py-1.5 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Reports</span>
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.kepalatoko.index') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-[#064e3b] transition">
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