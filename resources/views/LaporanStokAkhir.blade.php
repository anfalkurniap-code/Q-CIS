<?php
$items = [
    [
        'sku' => 'DRK-990-1',
        'name' => 'Premium Arabica Blend 1kg',
        'category' => 'Beverages'
    ],
    [
        'sku' => 'ELC-204-M',
        'name' => 'Smart Scale v2.0',
        'category' => 'Electronics'
    ],
    [
        'sku' => 'FOD-112-S',
        'name' => 'Cheddar Cheese Block 2kg',
        'category' => 'Dairy'
    ],
    [
        'sku' => 'CLO-001-B',
        'name' => 'Staff Uniform - Black (M)',
        'category' => 'Apparel'
    ],
    [
        'sku' => 'DRK-221-X',
        'name' => 'Mineral Water Case (24x)',
        'category' => 'Beverages'
    ],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Ops - Laporan Stok Akhir</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
        }
        
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen bg-slate-100 p-0 sm:p-4">

    <div class="w-full max-w-[390px] bg-[#f8fafc] min-h-screen sm:min-h-[844px] sm:rounded-[32px] shadow-2xl flex flex-col relative overflow-hidden border border-slate-200">
        
        <div class="flex items-center justify-between px-5 py-4 bg-white border-b border-slate-100 sticky top-0 z-20">
            <div class="flex items-center gap-3">
                <button class="text-slate-600 focus:outline-none">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <span class="font-bold text-emerald-950 text-lg tracking-tight">Store Ops</span>
            </div>
            <button class="text-slate-500 hover:text-slate-700">
                <i class="fa-regular fa-bell text-lg"></i>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto px-4 pt-5 pb-24 no-scrollbar space-y-4">
            
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Laporan Stok Akhir</h1>
                <p class="text-xs text-slate-500 mt-1 leading-snug">Laporan audit inventaris real-time per hari ini.</p>
                
                <div class="flex items-center gap-2 mt-3">
                    <button class="flex-1 flex items-center justify-center gap-1.5 border border-slate-300 rounded-lg py-1.5 px-3 bg-white text-xs font-semibold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                        <i class="fa-solid fa-download text-[11px] text-slate-500"></i>
                        <span>Export PDF</span>
                    </button>
                    <button class="flex-1 bg-[#064e3b] text-white text-xs font-medium rounded-lg py-2 px-3 hover:bg-[#043e2f] shadow-sm transition-all text-center">
                        Audit Selesai
                    </button>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] font-bold text-slate-500 tracking-wider uppercase">TOTAL NILAI INVENTARIS</span>
                    <div class="p-1.5 bg-emerald-50 rounded-lg text-emerald-700">
                        <i class="fa-regular fa-credit-card text-sm"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="text-[22px] font-bold text-[#064e3b] leading-none">
                        Rp 1.420.500.000
                    </div>
                    <div class="flex items-center gap-1 mt-2 text-[11px] font-medium text-emerald-600">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                        <span>+2.4% dari bulan lalu</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] font-bold text-slate-500 tracking-wider uppercase">UNIT TERSEDIA</span>
                    <div class="p-1.5 bg-emerald-50 rounded-lg text-emerald-700">
                        <i class="fa-solid fa-boxes-stacked text-sm"></i>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-bold text-slate-800">12,842</span>
                        <span class="text-xs text-slate-500 font-medium">SKU Units</span>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1">Total 452 kategori produk terpantau</p>
                </div>
            </div>

            <!-- Card 3: Status Kritis -->
            <div class="bg-[#fee2e2]/60 border border-red-200/80 rounded-2xl p-4 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[11px] font-bold text-red-700 tracking-wider uppercase">STATUS KRITIS</span>
                    <i class="fa-solid fa-triangle-exclamation text-red-600 text-sm"></i>
                </div>
                <div class="flex items-center pt-1">
                    <div class="flex-1">
                        <div class="text-xl font-extrabold text-red-600">14</div>
                        <div class="text-[11px] font-semibold text-red-600/90">Out of Stock</div>
                    </div>
                    <div class="w-[1px] h-8 bg-red-200/80 mx-2"></div>
                    <div class="flex-1 pl-2">
                        <div class="text-xl font-extrabold text-red-600">28</div>
                        <div class="text-[11px] font-semibold text-red-600/90">Low Stock</div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Breakdown Stok Akhir & Tabel -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="p-4 pb-3">
                    <h2 class="text-xs font-semibold text-slate-700 mb-2">Breakdown Stok Akhir</h2>
                    <!-- Input Cari -->
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" placeholder="Cari SKU atau Nama Item..." class="w-full bg-slate-100/80 text-xs pl-8 pr-3 py-2 rounded-lg text-slate-700 focus:outline-none focus:ring-1 focus:ring-slate-300 placeholder-slate-400">
                    </div>
                </div>

                <!-- Table -->
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-left text-[11px]">
                        <thead>
                            <tr class="bg-[#f1f5f9] text-slate-500 font-semibold border-y border-slate-200/60 uppercase tracking-wider">
                                <th class="py-2.5 px-3">SKU ID</th>
                                <th class="py-2.5 px-3">ITEM NAME</th>
                                <th class="py-2.5 px-3">CATEGORY</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <?php foreach ($items as $item): ?>
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-3 align-top font-medium text-slate-500 whitespace-nowrap">
                                    <?= htmlspecialchars($item['sku']); ?>
                                </td>
                                <td class="py-3 px-3 align-top font-bold text-slate-800 leading-snug">
                                    <?= htmlspecialchars($item['name']); ?>
                                </td>
                                <td class="py-3 px-3 align-top text-slate-600 font-medium">
                                    <?= htmlspecialchars($item['category']); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                <div class="flex items-center justify-between p-3 bg-slate-50/50 border-t border-slate-100 text-[11px] text-slate-500">
                    <span>Menampilkan 1-5 dari 452 SKU</span>
                    <div class="flex items-center gap-1 font-medium">
                        <button class="w-5 h-5 flex items-center justify-center text-slate-400 hover:text-slate-600">&lt;</button>
                        <button class="w-5 h-5 rounded-full bg-[#064e3b] text-white flex items-center justify-center font-semibold">1</button>
                        <button class="w-5 h-5 flex items-center justify-center text-slate-600 hover:bg-slate-200 rounded">2</button>
                        <button class="w-5 h-5 flex items-center justify-center text-slate-600 hover:bg-slate-200 rounded">3</button>
                        <button class="w-5 h-5 flex items-center justify-center text-slate-600 hover:text-slate-900">&gt;</button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom Navigation Bar (Fixed) -->
        <div class="absolute bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-4 py-2 flex justify-around items-center z-30">
            <!-- Home -->
            <a href="#" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-house text-base"></i>
                <span class="text-[10px] font-medium">Home</span>
            </a>
            
            <!-- Stok (Active Tab) -->
            <a href="#" class="flex flex-col items-center gap-0.5 text-[#064e3b]">
                <div class="w-12 h-7 bg-[#064e3b] rounded-full flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-boxes-stacked text-sm"></i>
                </div>
                <span class="text-[10px] font-bold">Stok</span>
            </a>

            <!-- Orders -->
            <a href="#" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-receipt text-base"></i>
                <span class="text-[10px] font-medium">Orders</span>
            </a>

            <!-- Staff -->
            <a href="#" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-user-group text-base"></i>
                <span class="text-[10px] font-medium">Staff</span>
            </a>
        </div>

    </div>

</body>
</html>