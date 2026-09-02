<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Stok Kritis</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font (Inter / Roboto Mono) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono-custom { font-family: 'Roboto Mono', monospace; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-200 min-h-screen flex items-center justify-center p-0 sm:p-4">

    <!-- Container Tampilan Mobile (Max Width Screen) -->
    <div class="w-full max-w-[420px] bg-[#f8fafb] min-h-screen sm:min-h-[840px] shadow-2xl relative flex flex-col justify-between overflow-hidden sm:rounded-3xl border border-slate-200">

        <!-- CONTENT SECTION (Scrollable) -->
        <div class="overflow-y-auto pb-24">

            <!-- 1. Header Top Navbar -->
            <header class="bg-white px-5 py-4 flex items-center justify-between border-b border-slate-100 sticky top-0 z-20 shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="text-[#024d35] text-xl">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                    <span class="text-xl font-extrabold text-[#024d35] tracking-tight">Q-CIS</span>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="p-4 space-y-4">

                <!-- Card Total Stok Kritis Dinamis -->
                <div class="bg-[#024d35] text-white rounded-2xl p-5 relative overflow-hidden shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation text-8xl absolute -right-3 -bottom-3 text-emerald-900/40 pointer-events-none"></i>
                    
                    <p class="text-[10px] font-extrabold tracking-widest text-emerald-300 uppercase mb-1">TOTAL STOK KRITIS</p>
                    <div class="flex items-baseline gap-2 mb-1">
                        <span class="text-4xl font-black text-[#00f0aa] font-mono-custom">
                            {{ sprintf('%02d', $stokKritisCount ?? count($itemsKritis ?? [])) }}
                        </span>
                        <span class="text-base font-bold text-emerald-100">Barang</span>
                    </div>
                    <p class="text-xs text-emerald-100/80 font-medium max-w-[200px]">Perlu tindakan segera hari ini.</p>
                </div>

            
                <!-- List Items Kritis Dinamis -->
                <div class="space-y-3">
                    @forelse($itemsKritis ?? [] as $item)
                        @php
                            $stok = $item->stock ?? 0;
                            $ambang = $item->threshold ?? 100;
                            // Persentase stok terhadap ambang batas (maksimal 100%)
                            $percentage = min(100, max(0, ($ambang > 0 ? ($stok / $ambang) * 100 : 0)));
                            $isVeryCritical = $percentage <= 30;
                        @endphp

                        <div class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-sm space-y-3">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $item->image_url ?? 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?w=150' }}" 
                                         alt="{{ $item->name ?? 'Barang' }}" 
                                         class="w-14 h-14 rounded-xl object-cover border border-slate-100">
                                    <div>
                                        <h3 class="font-extrabold text-slate-800 text-sm leading-snug">
                                            {{ $item->name ?? 'Nama Barang' }}
                                        </h3>
                                        <p class="text-[11px] text-slate-400 font-bold font-mono-custom mt-0.5">
                                            ID: {{ $item->sku ?? 'SKU-0000' }}
                                        </p>

                                        @if($isVeryCritical)
                                            <span class="inline-block mt-1 px-2 py-0.5 bg-red-100 text-red-600 font-extrabold text-[9px] rounded uppercase tracking-wider">
                                                SANGAT KRITIS
                                            </span>
                                        @else
                                            <span class="inline-block mt-1 px-2 py-0.5 bg-amber-100 text-amber-700 font-extrabold text-[9px] rounded uppercase tracking-wider">
                                                STOK MENIPIS
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <button class="text-slate-400 hover:text-slate-600 p-1">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                            </div>

                            <div class="space-y-1.5">
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-600 font-medium">
                                        Stok Saat Ini: <strong class="{{ $isVeryCritical ? 'text-red-600' : 'text-amber-600' }} font-extrabold">{{ $stok }} {{ $item->unit ?? 'pcs' }}</strong>
                                    </span>
                                    <span class="text-slate-400 font-medium">Ambang: {{ $ambang }} {{ $item->unit ?? 'pcs' }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="{{ $isVeryCritical ? 'bg-red-500' : 'bg-amber-500' }} h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>

                            <a href="{{ route('kelola.gudang') }}" class="block text-center w-full py-2 border-2 border-[#024d35] text-[#024d35] font-extrabold rounded-xl text-xs hover:bg-[#024d35] hover:text-white transition-colors">
                                Detail
                            </a>
                        </div>
                    @empty
                        <div class="bg-white border border-slate-200/90 rounded-2xl p-8 text-center text-slate-500">
                            <i class="fa-solid fa-[#029668] fa-circle-check text-3xl text-emerald-500 mb-2 block"></i>
                            <p class="text-xs font-semibold text-slate-700">Tidak ada stok dalam kondisi kritis.</p>
                            <p class="text-[11px] text-slate-400 mt-0.5">Semua persediaan barang aman.</p>
                        </div>
                    @endforelse
                </div>

            </main>
        </div>

        <!-- Floating Action Button (+ Plus) -->
        <div class="absolute bottom-16 right-4 z-20">
            <a href="{{ route('input.barang') }}" class="w-12 h-12 bg-[#024d35] text-white rounded-2xl flex items-center justify-center shadow-xl hover:bg-[#013826] transition-all">
                <i class="fa-solid fa-plus text-lg"></i>
            </a>
        </div>

        <!-- Bottom Navigation Bar (Fixed at bottom) -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-3 py-2 flex items-center justify-around z-30">
            <!-- Tab Dashboard -->
            <a href="{{ route('dashboard.gudang') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-border-all text-base mb-0.5"></i>
                <span>Dashboard</span>
            </a>

            <!-- Tab Kelola -->
            <a href="{{ route('kelola.gudang') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-box-archive text-base mb-0.5"></i>
                <span>Kelola</span>
            </a>

            <!-- Tab Input -->
            <a href="{{ route('input.barang') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-square-plus text-base mb-0.5"></i>
                <span>Input</span>
            </a>

            <!-- Active Tab (Kritis) -->
            <a href="{{ route('stok.kritis') }}" class="flex flex-col items-center justify-center bg-[#00f0aa] text-[#024d35] px-4 py-1.5 rounded-xl font-bold text-[10px]">
                <i class="fa-solid fa-triangle-exclamation text-base mb-0.5"></i>
                <span>Kritis</span>
            </a>

            <!-- Tab Profile -->
            <a href="{{ route('profil.gudang') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-user text-base mb-0.5"></i>
                <span>Profile</span>
            </a>
        </nav>

    </div>

</body>
</html>