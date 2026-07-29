<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Kelola Gudang</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono-custom { font-family: 'Roboto Mono', monospace; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-200 min-h-screen flex items-center justify-center p-0 sm:p-4">

    <!-- Container Tampilan Mobile -->
    <div class="w-full max-w-[420px] bg-[#f8fafb] min-h-screen sm:min-h-[840px] shadow-2xl relative flex flex-col justify-between overflow-hidden sm:rounded-3xl border border-slate-200">

        <!-- CONTENT SECTION -->
        <div class="overflow-y-auto pb-24">

            <!-- Header Navbar -->
            <header class="bg-white px-5 py-4 flex items-center justify-between border-b border-slate-100 sticky top-0 z-20 shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="text-[#024d35] text-xl">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                    <span class="text-xl font-extrabold text-[#024d35] tracking-tight">Q-CIS</span>
                </div>
                <button class="relative text-slate-600 hover:text-slate-900 transition">
                    <i class="fa-regular fa-bell text-xl"></i>
                </button>
            </header>

            <!-- Main Content Container -->
            <main class="p-4 space-y-4">

                <!-- Ringkasan Stok (2 Cards Grid) -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-4 shadow-sm">
                        <span class="text-[10px] font-extrabold text-slate-400 tracking-wider uppercase block">TOTAL SKU</span>
                        <div class="text-2xl font-black text-[#024d35] mt-1 font-mono-custom">
                            {{ $totalSku }}
                        </div>
                    </div>

                    <div class="bg-[#fde2e2] border border-red-200/80 rounded-2xl p-4 shadow-sm">
                        <span class="text-[10px] font-extrabold text-red-600 tracking-wider uppercase block">STOK KRITIS</span>
                        <div class="text-2xl font-black text-red-700 mt-1 flex items-center gap-1.5 font-mono-custom">
                            <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                            <span>{{ $stokKritisCount }}</span>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="relative flex items-center">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 text-slate-400 text-sm"></i>
                    <input 
                        type="text" 
                        placeholder="Cari SKU atau Nama Barang..." 
                        class="w-full bg-slate-100/80 border border-slate-200 text-xs font-medium text-slate-700 pl-10 pr-10 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#024d35] placeholder:text-slate-400"
                    />
                    <button class="absolute right-3.5 text-slate-500 hover:text-[#024d35] transition">
                        <i class="fa-solid fa-barcode text-base"></i>
                    </button>
                </div>

                <!-- Filter Kategori -->
                <div class="flex items-center gap-2 overflow-x-auto no-scrollbar py-1">
                    <button class="bg-[#024d35] text-white px-4 py-2 rounded-xl text-xs font-bold shrink-0 shadow-sm">
                        Semua
                    </button>
                    <button class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-3.5 py-2 rounded-xl text-xs font-semibold shrink-0 transition">
                        Suku Cadang
                    </button>
                    <button class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-3.5 py-2 rounded-xl text-xs font-semibold shrink-0 transition">
                        Pelumas
                    </button>
                    <button class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-3.5 py-2 rounded-xl text-xs font-semibold shrink-0 transition">
                        Ban
                    </button>
                    <button class="bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 px-3.5 py-2 rounded-xl text-xs font-semibold shrink-0 transition">
                        Elektronik
                    </button>
                </div>

                <!-- List Barang Gudang -->
                <div class="space-y-3">
                    @foreach($items as $item)
                    <div class="bg-white border {{ $item['is_kritis'] ? 'border-red-300 ring-1 ring-red-300' : 'border-slate-200/90' }} rounded-2xl p-4 shadow-sm relative">
                        
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <span class="text-[11px] font-extrabold text-[#029668] font-mono-custom tracking-wide">
                                    {{ $item['sku'] }}
                                </span>
                                <h3 class="text-sm font-bold text-slate-800 tracking-tight mt-0.5">
                                    {{ $item['nama'] }}
                                </h3>
                            </div>
                            <button class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-600 transition shrink-0">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-2 gap-2 mt-3 pt-3 border-t border-slate-100">
                            <div>
                                <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider block">KATEGORI</span>
                                <span class="text-xs font-bold text-slate-700">{{ $item['kategori'] }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider block">STOK</span>
                                <span class="text-sm font-black font-mono-custom {{ $item['is_kritis'] ? 'text-red-600' : 'text-[#024d35]' }}">
                                    {{ $item['stok'] }} <span class="text-xs font-normal text-slate-500">{{ $item['satuan'] }}</span>
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-3 pt-2">
                            <div class="flex items-center gap-2">
                                @if($item['is_kritis'])
                                    <span class="bg-red-100 text-red-700 text-[9px] font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider">
                                        KRITIS
                                    </span>
                                @else
                                    <span class="bg-emerald-100 text-emerald-800 text-[9px] font-extrabold px-2 py-0.5 rounded-md uppercase tracking-wider">
                                        TERSEDIA
                                    </span>
                                @endif
                                <span class="text-[11px] font-semibold text-slate-500">
                                    <i class="fa-solid fa-location-dot text-slate-400 mr-0.5"></i> {{ $item['lokasi'] }}
                                </span>
                            </div>

                            <button class="bg-[#024d35] hover:bg-[#013827] text-white text-[10px] font-extrabold px-3 py-1.5 rounded-xl flex items-center gap-1.5 transition shadow-sm">
                                <i class="fa-solid fa-box-archive text-[10px]"></i>
                                <span>UPDATE</span>
                            </button>
                        </div>

                    </div>
                    @endforeach
                </div>

            </main>
        </div>

        <!-- Tombol Floating Add (+) -->
        <button class="absolute bottom-20 right-5 bg-[#00f0aa] text-[#024d35] w-12 h-12 rounded-2xl shadow-lg border border-[#024d35]/20 flex items-center justify-center hover:scale-105 active:scale-95 transition z-20">
            <i class="fa-solid fa-plus text-xl font-bold"></i>
        </button>

        <!-- Bottom Navigation Bar -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-3 py-2 flex items-center justify-around z-30">
            <a href="{{ route('dashboard.gudang') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-border-all text-base mb-0.5"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kelola.gudang') }}" class="flex flex-col items-center justify-center bg-[#00f0aa] text-[#024d35] px-4 py-1.5 rounded-xl font-bold text-[10px]">
                <i class="fa-solid fa-box-archive text-base mb-0.5"></i>
                <span>Kelola</span>
            </a>

            <a href="#" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-square-plus text-base mb-0.5"></i>
                <span>Input</span>
            </a>

            <a href="#" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition relative">
                <div class="relative">
                    <i class="fa-solid fa-triangle-exclamation text-base mb-0.5"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </div>
                <span>Kritis</span>
            </a>

            <a href="{{ route('profil.gudang') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-user text-base mb-0.5"></i>
                <span>Profile</span>
            </a>
        </nav>

    </div>

</body>
</html>