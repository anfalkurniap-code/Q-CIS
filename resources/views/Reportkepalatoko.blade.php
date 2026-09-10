<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi & Inventaris - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @php use Illuminate\Support\Facades\Storage; @endphp
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
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight leading-tight">Persetujuan Barang Masuk</h1>
                <p class="text-xs text-slate-500 mt-0.5">Setujui atau tolak barang yang diajukan petugas gudang.</p>
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

        <!-- Scrollable Item List -->
        <div class="px-4 pt-3 pb-24 space-y-3 overflow-y-auto flex-1">
            
            @forelse($barangMasuk ?? [] as $item)
                <div class="bg-white rounded-2xl shadow-sm border {{ ($item->status ?? 'pending') == 'pending' ? 'border-amber-200' : (($item->status ?? '') == 'approved' ? 'border-emerald-200' : 'border-rose-200') }} overflow-hidden">
                    
                    {{-- Foto Produk (jika ada) --}}
                    @if(!empty($item->image))
                        <div class="w-full h-28 bg-slate-100 overflow-hidden">
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover">
                        </div>
                    @endif

                    <div class="p-3 flex items-start justify-between gap-2">
                        <div class="flex-1 min-w-0">
                            {{-- Badge Status --}}
                            @if(($item->status ?? 'pending') == 'pending')
                                <span class="inline-block text-[9px] font-bold bg-amber-100 text-amber-700 px-2 py-0.5 rounded-md mb-1">⏳ Menunggu</span>
                            @elseif($item->status == 'approved')
                                <span class="inline-block text-[9px] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-md mb-1">✓ Disetujui</span>
                            @else
                                <span class="inline-block text-[9px] font-bold bg-rose-100 text-rose-700 px-2 py-0.5 rounded-md mb-1">✕ Ditolak</span>
                            @endif

                            {{-- Nama Barang --}}
                            <h3 class="text-xs font-bold text-slate-900 leading-snug truncate">{{ $item->nama_barang }}</h3>

                            {{-- Detail Info --}}
                            <div class="mt-1 space-y-0.5">
                                <div class="flex items-center gap-1.5 text-[10px] text-slate-500">
                                    <span class="font-bold text-slate-700">{{ number_format($item->jumlah ?? 0) }} Pcs</span>
                                    <span>•</span>
                                    <span>Jual: <strong class="text-slate-800">Rp{{ number_format($item->harga ?? 0, 0, ',', '.') }}</strong></span>
                                </div>
                                @if(!empty($item->purchase_price))
                                    <p class="text-[10px] text-slate-400">Beli: Rp{{ number_format($item->purchase_price, 0, ',', '.') }}</p>
                                @endif
                                @if(!empty($item->barcode))
                                    <p class="text-[10px] text-slate-400 font-mono">Barcode: {{ $item->barcode }}</p>
                                @endif
                            </div>

                            {{-- Waktu Input --}}
                            <p class="text-[10px] text-slate-400 mt-1">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y • H:i') }}</p>
                        </div>

                        {{-- Tombol Aksi --}}
                        @if(($item->status ?? 'pending') == 'pending')
                            <div class="flex flex-col gap-1.5 shrink-0">
                                <form action="{{ route('report.approve', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold px-3 py-1.5 rounded-lg transition shadow-sm whitespace-nowrap">
                                        ✓ Setujui
                                    </button>
                                </form>
                                <form action="{{ route('report.reject', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white text-[10px] font-bold px-3 py-1.5 rounded-lg transition shadow-sm whitespace-nowrap">
                                        ✕ Tolak
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-xs text-slate-400">Belum ada pengajuan barang masuk.</p>
                </div>
            @endforelse

        </div>

        <!-- Bottom Navigation Bar -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-6 py-2 flex items-center justify-around z-20">
            <a href="{{ route('dashboard.kepalatoko') }}" class="flex flex-col items-center gap-1 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Dashboard</span>
            </a>

            <a href="{{ route('report.kepalatoko') }}" class="flex flex-col items-center gap-1 text-[#064e3b]">
                <div class="px-4 py-1.5 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Reports</span>
            </a>

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