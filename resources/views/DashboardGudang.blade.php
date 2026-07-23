<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font (Inter / Roboto Mono) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-mono-custom { font-family: 'Roboto Mono', monospace; }
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
                <button class="relative text-slate-600 hover:text-slate-900 transition">
                    <i class="fa-regular fa-bell text-xl"></i>
                </button>
            </header>

            <!-- Main Content Container -->
            <main class="p-4 space-y-4">

                <!-- 2. Warning Card (Peringatan Stok Rendah) -->
                <div class="bg-[#fde2e2] border border-red-200/80 rounded-2xl p-5 text-center flex flex-col items-center justify-center relative overflow-hidden">
                    <div class="flex items-center gap-2 text-red-700 font-extrabold text-base mb-3">
                        <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        <span>Peringatan Stok Rendah</span>
                    </div>
                    
                    <!-- Badge Stok -->
                    <div class="bg-[#fcebeb] border border-red-300 rounded-xl px-5 py-2 inline-flex flex-col items-center shadow-sm">
                        <span class="text-red-700 font-black text-xl leading-none font-mono-custom">08</span>
                        <span class="text-[10px] font-extrabold text-red-600 tracking-wider uppercase mt-0.5">LOW STOK</span>
                    </div>
                </div>

                <!-- 3. Alert Card (Sinyal Peringatan Dini) -->
                <div class="bg-[#e0e8f9] border-l-4 border-red-500 rounded-r-2xl p-3.5 flex items-start gap-3 shadow-sm">
                    <div class="text-red-600 text-lg mt-0.5">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-extrabold text-red-600 uppercase tracking-wider leading-tight">SINYAL PERINGATAN DINI</h4>
                        <p class="text-xs text-slate-600 font-medium leading-relaxed mt-0.5">
                            <span class="font-bold text-slate-700">3 SKU</span> baru mencapai ambang batas minimum.
                        </p>
                    </div>
                </div>

                <!-- 4. Title Operational View -->
                <div class="pt-1">
                    <span class="text-[10px] font-extrabold text-slate-500 uppercase tracking-widest block mb-0.5">OPERATIONAL VIEW</span>
                    <h2 class="text-lg font-bold text-[#024d35]">Warehouse Dashboard</h2>
                </div>

                <!-- 5. List Barang Masuk Hari Ini -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-bold text-[#024d35]">Barang Masuk Hari Ini</h3>
                        <span class="text-xs font-semibold text-slate-500">Total: <strong class="text-slate-700">48 SKU</strong></span>
                    </div>

                    <!-- Items Loop -->
                    <div class="space-y-3">
                        @php
                            $barangMasuk = [
                                [
                                    'jam' => '08:45 AM',
                                    'sku' => 'BOSCH-DRILL-X2',
                                    'qty' => '250 Units'
                                ],
                                [
                                    'jam' => '10:15 AM',
                                    'sku' => 'LUBE-IND-40L',
                                    'qty' => '45 Drums'
                                ],
                                [
                                    'jam' => '11:30 AM',
                                    'sku' => 'HVY-CHAIN-GRD8',
                                    'qty' => '120 Meters'
                                ],
                                [
                                    'jam' => '01:05 PM',
                                    'sku' => 'SOLAR-PANEL-W600',
                                    'qty' => '60 Panels'
                                ]
                            ];
                        @endphp

                        @foreach($barangMasuk as $item)
                        <div class="bg-white border border-slate-200/90 rounded-2xl p-4 shadow-sm hover:border-slate-300 transition">
                            <div class="text-[12px] font-bold text-[#029668] tracking-wide mb-1 font-mono-custom">
                                {{ $item['jam'] }}
                            </div>
                            <h4 class="text-sm font-extrabold text-slate-800 tracking-tight mb-3">
                                {{ $item['sku'] }}
                            </h4>
                            
                            <div class="border-t border-slate-100 pt-2.5 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-1.5 text-slate-500 font-medium">
                                    <i class="fa-solid fa-box text-slate-400"></i>
                                    <span>QTY: <strong class="text-slate-700">{{ $item['qty'] }}</strong></span>
                                </div>
                                <a href="#" class="text-[#024d35] font-bold hover:underline flex items-center gap-1">
                                    <span>Details</span>
                                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </main>
        </div>

        <!-- 6. Bottom Navigation Bar (Fixed at bottom) -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-3 py-2 flex items-center justify-around z-30">
            <!-- Active Tab (Dashboard) -->
            <a href="{{ route('dashboard.gudang') }}" class="flex flex-col items-center justify-center bg-[#00f0aa] text-[#024d35] px-4 py-1.5 rounded-xl font-bold text-[10px]">
                <i class="fa-solid fa-border-all text-base mb-0.5"></i>
                <span>Dashboard</span>
            </a>

            <!-- Tab Kelola -->
            <a href="#" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-solid fa-box-archive text-base mb-0.5"></i>
                <span>Kelola</span>
            </a>

            <!-- Tab Input -->
            <a href="#" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-square-plus text-base mb-0.5"></i>
                <span>Input</span>
            </a>

            <!-- Tab Kritis -->
            <a href="#" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition relative">
                <div class="relative">
                    <i class="fa-solid fa-triangle-exclamation text-base mb-0.5"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </div>
                <span>Kritis</span>
            </a>

            <!-- Tab Profile (DIHUBUNGKAN KE ROUTE PROFIL) -->
            <a href="{{ route('profil.gudang') }}" class="flex flex-col items-center justify-center text-slate-500 hover:text-[#024d35] py-1 text-[10px] font-bold transition">
                <i class="fa-regular fa-user text-base mb-0.5"></i>
                <span>Profile</span>
            </a>
        </nav>

    </div>

</body>
</html>