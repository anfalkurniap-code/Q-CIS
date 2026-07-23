@php
$items = [
    [
        'sku' => 'DRK-990-1',
        'name' => 'Premium Arabica Blend 1kg',
        'category' => 'Beverages',
        'stock' => 120,
        'unit' => 'Pcs',
        'status' => 'Aman',
        'price' => 'Rp 150.000'
    ],
    [
        'sku' => 'ELC-204-M',
        'name' => 'Smart Scale v2.0',
        'category' => 'Electronics',
        'stock' => 5,
        'unit' => 'Unit',
        'status' => 'Low Stock',
        'price' => 'Rp 450.000'
    ],
    [
        'sku' => 'FOD-112-S',
        'name' => 'Cheddar Cheese Block 2kg',
        'category' => 'Dairy',
        'stock' => 0,
        'unit' => 'Pack',
        'status' => 'Out of Stock',
        'price' => 'Rp 95.000'
    ],
    [
        'sku' => 'CLO-001-B',
        'name' => 'Staff Uniform - Black (M)',
        'category' => 'Apparel',
        'stock' => 45,
        'unit' => 'Pcs',
        'status' => 'Aman',
        'price' => 'Rp 125.000'
    ],
    [
        'sku' => 'DRK-221-X',
        'name' => 'Mineral Water Case (24x)',
        'category' => 'Beverages',
        'stock' => 8,
        'unit' => 'Dus',
        'status' => 'Low Stock',
        'price' => 'Rp 48.000'
    ],
];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Ops - Laporan Stok Akhir</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
        }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen relative pb-24 bg-slate-100">

    <!-- Header Atas (Top Navbar) -->
    <header class="bg-white border-b border-slate-200 px-4 md:px-8 py-4 flex items-center justify-between sticky top-0 z-20 shadow-sm">
        <div class="flex items-center gap-3">
            <button class="text-slate-600 md:hidden focus:outline-none">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-[#064e3b] flex items-center justify-center text-white font-bold">
                    <i class="fa-solid fa-boxes-stacked text-sm"></i>
                </div>
                <span class="font-bold text-slate-800 text-lg tracking-tight">Store Ops</span>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button class="relative text-slate-500 hover:text-slate-700 p-2 rounded-full hover:bg-slate-100 transition">
                <i class="fa-regular fa-bell text-lg"></i>
                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <div class="hidden md:flex items-center gap-3 border-l border-slate-200 pl-4">
                <div class="w-8 h-8 bg-emerald-100 text-[#064e3b] font-bold rounded-full flex items-center justify-center text-xs">
                    KT
                </div>
                <div>
                    <div class="text-xs font-semibold text-slate-700">Kepala Toko</div>
                    <div class="text-[10px] text-slate-400">Main Branch</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama (Otomatis menyesuaikan Mobile & Desktop) -->
    <main class="max-w-6xl mx-auto px-4 md:px-8 pt-6 space-y-6">
        
        <!-- Judul & Tombol Aksi -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Laporan Stok Akhir</h1>
                <p class="text-xs md:text-sm text-slate-500 mt-1 leading-snug">Laporan audit inventaris real-time per hari ini.</p>
            </div>
            
            <div class="flex items-center gap-2">
                <button class="flex-1 md:flex-none flex items-center justify-center gap-2 border border-slate-300 rounded-xl md:rounded-lg py-2 px-4 bg-white text-xs md:text-sm font-semibold text-slate-700 hover:bg-slate-50 shadow-sm transition">
                    <i class="fa-solid fa-download text-slate-500"></i>
                    <span>Export PDF</span>
                </button>
                <button class="flex-1 md:flex-none bg-[#064e3b] text-white text-xs md:text-sm font-semibold rounded-xl md:rounded-lg py-2 px-4 hover:bg-[#043e2f] shadow-sm transition text-center">
                    Audit Selesai
                </button>
            </div>
        </div>

        <!-- Metric Cards (1 Kolom di Mobile, 3 Kolom di Desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            
            <!-- Card 1: Total Nilai Inventaris -->
            <div class="bg-white rounded-2xl md:rounded-xl p-4 md:p-5 border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] md:text-xs font-bold text-slate-500 tracking-wider uppercase">TOTAL NILAI INVENTARIS</span>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-700">
                        <i class="fa-regular fa-credit-card text-sm md:text-base"></i>
                    </div>
                </div>
                <div class="mt-2 md:mt-3">
                    <div class="text-2xl md:text-3xl font-bold text-[#064e3b]">
                        Rp 1.420.500.000
                    </div>
                    <div class="flex items-center gap-1.5 mt-2 text-xs font-medium text-emerald-600">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                        <span>+2.4% dari bulan lalu</span>
                    </div>
                </div>
            </div>

            <!-- Card 2: Unit Tersedia -->
            <div class="bg-white rounded-2xl md:rounded-xl p-4 md:p-5 border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start">
                    <span class="text-[11px] md:text-xs font-bold text-slate-500 tracking-wider uppercase">UNIT TERSEDIA</span>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-700">
                        <i class="fa-solid fa-boxes-stacked text-sm md:text-base"></i>
                    </div>
                </div>
                <div class="mt-2 md:mt-3">
                    <div class="flex items-baseline gap-2">
                        <span class="text-2xl md:text-3xl font-bold text-slate-800">12,842</span>
                        <span class="text-xs text-slate-500 font-medium">SKU Units</span>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Total 452 kategori produk terpantau</p>
                </div>
            </div>

            <!-- Card 3: Status Kritis -->
            <div class="bg-[#fee2e2]/60 border border-red-200/80 rounded-2xl md:rounded-xl p-4 md:p-5 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[11px] md:text-xs font-bold text-red-700 tracking-wider uppercase">STATUS KRITIS</span>
                    <i class="fa-solid fa-triangle-exclamation text-red-600 text-sm md:text-base"></i>
                </div>
                <div class="flex items-center pt-2">
                    <div class="flex-1">
                        <div class="text-xl md:text-2xl font-extrabold text-red-600">14</div>
                        <div class="text-xs font-semibold text-red-600">Out of Stock</div>
                    </div>
                    <div class="w-[1px] h-8 md:h-10 bg-red-200 mx-3 md:mx-4"></div>
                    <div class="flex-1 pl-2">
                        <div class="text-xl md:text-2xl font-extrabold text-red-600">28</div>
                        <div class="text-xs font-semibold text-red-600">Low Stock</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Card Breakdown Stok & Tabel -->
        <div class="bg-white rounded-2xl md:rounded-xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-4 md:p-5 flex flex-col md:flex-row md:items-center justify-between gap-3 border-b border-slate-100">
                <h2 class="text-xs md:text-base font-bold text-slate-800">Breakdown Stok Akhir</h2>
                <div class="relative w-full md:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs md:text-sm"></i>
                    <input type="text" placeholder="Cari SKU atau Nama Item..." class="w-full bg-slate-100/80 md:bg-slate-50 border border-transparent md:border-slate-200 text-xs md:text-sm pl-8 md:pl-9 pr-3 py-2 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600">
                </div>
            </div>

            <!-- Table Responsif -->
            <div class="w-full overflow-x-auto">
                <table class="w-full text-left text-xs md:text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 font-semibold border-b border-slate-200 uppercase text-[10px] md:text-xs tracking-wider">
                            <th class="py-3 px-4 md:px-6">SKU ID</th>
                            <th class="py-3 px-4 md:px-6">ITEM NAME</th>
                            <th class="py-3 px-4 md:px-6">CATEGORY</th>
                            <th class="hidden md:table-cell py-3 px-6">PRICE</th>
                            <th class="hidden md:table-cell py-3 px-6">STOCK</th>
                            <th class="hidden md:table-cell py-3 px-6">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach ($items as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 md:px-6 font-mono text-slate-500 font-medium whitespace-nowrap">
                                {{ $item['sku'] }}
                            </td>
                            <td class="py-3.5 px-4 md:px-6 font-bold text-slate-800 leading-snug">
                                {{ $item['name'] }}
                            </td>
                            <td class="py-3.5 px-4 md:px-6 text-slate-600 font-medium whitespace-nowrap">
                                {{ $item['category'] }}
                            </td>
                            <td class="hidden md:table-cell py-3.5 px-6 font-medium text-slate-800">
                                {{ $item['price'] }}
                            </td>
                            <td class="hidden md:table-cell py-3.5 px-6 font-semibold">
                                {{ $item['stock'] }} {{ $item['unit'] }}
                            </td>
                            <td class="hidden md:table-cell py-3.5 px-6">
                                @if ($item['status'] == 'Aman')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Aman</span>
                                @elseif ($item['status'] == 'Low Stock')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Low Stock</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Out of Stock</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination -->
            <div class="flex items-center justify-between p-3 md:p-4 bg-slate-50/50 border-t border-slate-100 text-[11px] md:text-xs text-slate-500">
                <span>Menampilkan 1-5 dari 452 SKU</span>
                <div class="flex items-center gap-1 font-medium">
                    <button class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-slate-600">&lt;</button>
                    <button class="w-6 h-6 rounded-full md:rounded bg-[#064e3b] text-white flex items-center justify-center font-bold">1</button>
                    <button class="w-6 h-6 rounded hover:bg-slate-200 text-slate-600 flex items-center justify-center">2</button>
                    <button class="w-6 h-6 rounded hover:bg-slate-200 text-slate-600 flex items-center justify-center">3</button>
                    <button class="w-6 h-6 flex items-center justify-center text-slate-600 hover:text-slate-900">&gt;</button>
                </div>
            </div>
        </div>

    </main>

    <!-- Bottom Navigation Bar (Fixed di Bawah - Berlaku untuk Mobile & Desktop) -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 px-6 py-2.5 z-30 shadow-[0_-4px_12px_rgba(0,0,0,0.05)]">
        <div class="max-w-md mx-auto flex justify-around items-center">
            
            <!-- Home -->
            <a href="#" class="flex flex-col items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-house text-base md:text-lg"></i>
                <span class="text-[10px] md:text-xs font-medium">Home</span>
            </a>
            
            <!-- Stok (Active Tab) -->
            <a href="#" class="flex flex-col items-center gap-1 text-[#064e3b]">
                <div class="w-12 md:w-14 h-7 bg-[#064e3b] rounded-full flex items-center justify-center text-white shadow-sm">
                    <i class="fa-solid fa-boxes-stacked text-sm"></i>
                </div>
                <span class="text-[10px] md:text-xs font-bold">Stok</span>
            </a>

            <!-- Orders -->
            <a href="#" class="flex flex-col items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-receipt text-base md:text-lg"></i>
                <span class="text-[10px] md:text-xs font-medium">Orders</span>
            </a>

            <!-- Staff -->
            <a href="#" class="flex flex-col items-center gap-1 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fa-solid fa-user-group text-base md:text-lg"></i>
                <span class="text-[10px] md:text-xs font-medium">Staff</span>
            </a>

        </div>
    </div>

</body>
</html>