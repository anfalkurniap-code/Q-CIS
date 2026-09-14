<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang Gudang - Q-CIS SMK MART</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center p-0 md:p-4">

    <!-- Container Frame HP -->
    <div class="w-full max-w-sm bg-[#f8faf9] h-screen md:h-[750px] md:max-h-[850px] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-between overflow-hidden">
        
        <!-- Header Top -->
        <div class="p-4 pb-2 space-y-3 bg-[#f8faf9] shrink-0">
            <div class="flex items-center justify-between text-[#064e3b]">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Q-CIS SMK MART</span>
                </div>

                <!-- Live Sync Badge -->
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-100/80 text-[10px] font-bold text-[#064e3b] border border-emerald-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Live Sync</span>
                </span>
            </div>

            <!-- Title & Subtitle -->
            <div>
                <h1 class="text-xl font-extrabold text-slate-900 tracking-tight leading-tight">Stok Barang Gudang</h1>
                <p class="text-xs text-slate-500 mt-0.5">Monitoring stok fisik terkini yang dikelola role Gudang.</p>
            </div>

            <!-- Summary Cards Grid -->
            <div class="grid grid-cols-2 gap-2 pt-1">
                <!-- Card 1: Total Ringkasan Barang -->
                <div class="bg-white p-3 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-[9px] font-bold uppercase text-slate-400">Total Barang</span>
                        <h3 id="totalItemsEl" class="text-lg font-extrabold text-slate-900 mt-0.5">{{ number_format($totalItems ?? 0) }}</h3>
                        <p class="text-[9px] text-slate-400">SKU / Produk</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-emerald-100/70 text-[#064e3b] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Peringatan Stok Rendah -->
                <div class="bg-white p-3 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-[9px] font-bold uppercase text-slate-400">Stok Menipis</span>
                        <h3 id="lowStockCountEl" class="text-lg font-extrabold text-rose-600 mt-0.5">{{ number_format($lowStockCount ?? 0) }}</h3>
                        <p class="text-[9px] text-rose-400 font-medium">Stok &le; 5 Unit</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-rose-100/70 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Live Search Bar -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" id="searchInput" value="{{ $search ?? '' }}" placeholder="Cari nama barang, SKU, atau kategori..." class="w-full pl-9 pr-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-[#064e3b] shadow-sm" oninput="onSearchChange(this.value)">
            </div>
        </div>

        <!-- Scrollable Item List -->
        <div class="px-4 pt-2 pb-24 space-y-2.5 overflow-y-auto flex-1" id="productListContainer">
            
            @forelse($products ?? [] as $product)
                @php
                    $sku = $product->barcode ?? ('SKU-' . str_pad($product->id, 4, '0', STR_PAD_LEFT));
                    $nama = $product->name ?? $product->product_name ?? 'Tanpa Nama';
                    $kategori = $product->category->name ?? 'Umum';
                    $stok = (int) $product->stock;
                    $isLow = $stok <= 5;
                @endphp
                <div class="bg-white rounded-2xl p-3 shadow-sm border border-slate-100 flex items-center gap-3 transition hover:shadow-md product-card" data-id="{{ $product->id }}" data-name="{{ strtolower($nama) }}" data-sku="{{ strtolower($sku) }}" data-category="{{ strtolower($kategori) }}">
                    <!-- Thumbnail / Icon Dus -->
                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center shrink-0 overflow-hidden border border-slate-200">
                        @if(!empty($product->img))
                            <img src="{{ $product->img }}" alt="{{ $nama }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        @endif
                    </div>

                    <!-- Item Detail -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-1.5">
                            <span class="text-[9px] font-mono font-bold text-slate-400 uppercase tracking-tight">{{ $sku }}</span>
                            <span class="text-[9px] font-bold px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 truncate max-w-[90px]">{{ $kategori }}</span>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 truncate mt-0.5">{{ $nama }}</h3>
                        <div class="flex items-center gap-2 mt-1 text-[10px] text-slate-500">
                            <span>Jual: <strong class="text-slate-800">Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}</strong></span>
                            <span>•</span>
                            <span>Beli: <strong class="text-slate-400">Rp{{ number_format($product->purchase_price ?? 0, 0, ',', '.') }}</strong></span>
                        </div>
                    </div>

                    <!-- Stok Realtime Badge -->
                    <div class="shrink-0 text-right">
                        <span class="stock-badge inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-xl {{ $isLow ? 'bg-rose-100 text-rose-700 border border-rose-200' : 'bg-emerald-100 text-[#064e3b] border border-emerald-200' }}">
                            @if($isLow)
                                ⚠️ <span class="stock-val">{{ $stok }}</span> Pcs
                            @else
                                <span class="stock-val">{{ $stok }}</span> Pcs
                            @endif
                        </span>
                        <span class="block text-[8px] font-semibold text-slate-400 mt-1 uppercase tracking-tight">Fisik Realtime</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-slate-100 shadow-sm" id="emptyState">
                    <svg class="w-10 h-10 text-slate-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="text-xs font-semibold text-slate-500">Tidak ada barang ditemukan</p>
                    <p class="text-[10px] text-slate-400 mt-0.5">Pastikan barang telah disetujui di menu Reports.</p>
                </div>
            @endforelse

        </div>

        <!-- Bottom Navbar (Urutan: Dashboard -> Stok Barang (Aktif) -> Reports -> Profile) -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-3 py-2 flex items-center justify-around z-20">
            
            <!-- 1. Dashboard -->
            <a href="{{ route('dashboard.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Dashboard</span>
            </a>

            <!-- 2. Stok Barang (AKTIF) -->
            <a href="{{ route('stok.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-[#064e3b]">
                <div class="px-3 py-1 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Stok Barang</span>
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

    <!-- Script JavaScript untuk Search Realtime & Polling Realtime Live Sync -->
    <script>
        let searchTimer = null;

        function onSearchChange(val) {
            const query = val.toLowerCase().trim();
            const cards = document.querySelectorAll('.product-card');

            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const sku = card.getAttribute('data-sku') || '';
                const category = card.getAttribute('data-category') || '';

                if (name.includes(query) || sku.includes(query) || category.includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });

            // Trigger server fetch with search term
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                fetchRealtimeStock();
            }, 400);
        }

        // Fetch Data Stok Realtime secara berkala (Auto Poll 3 Detik)
        async function fetchRealtimeStock() {
            const query = document.getElementById('searchInput').value;
            const url = `{{ route('stok.kepalatoko') }}?json=1&search=${encodeURIComponent(query)}`;

            try {
                const res = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!res.ok) return;

                const data = await res.json();

                // Update Ringkasan Total & Stok Menipis
                if (data.total_items !== undefined) {
                    document.getElementById('totalItemsEl').innerText = new Intl.NumberFormat('id-ID').format(data.total_items);
                }
                if (data.low_stock_count !== undefined) {
                    document.getElementById('lowStockCountEl').innerText = new Intl.NumberFormat('id-ID').format(data.low_stock_count);
                }

                // Update Angka Stok Setiap Barang di DOM tanpa reload
                if (data.products && Array.isArray(data.products)) {
                    data.products.forEach(p => {
                        const card = document.querySelector(`.product-card[data-id="${p.id}"]`);
                        if (card) {
                            const badge = card.querySelector('.stock-badge');
                            const stockValEl = card.querySelector('.stock-val');

                            if (stockValEl) {
                                stockValEl.innerText = p.stock;
                            }

                            if (badge) {
                                if (p.is_low) {
                                    badge.className = "stock-badge inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-xl bg-rose-100 text-rose-700 border border-rose-200";
                                    badge.innerHTML = `⚠️ <span class="stock-val">${p.stock}</span> Pcs`;
                                } else {
                                    badge.className = "stock-badge inline-flex items-center gap-1 text-[11px] font-extrabold px-2.5 py-1 rounded-xl bg-emerald-100 text-[#064e3b] border border-emerald-200";
                                    badge.innerHTML = `<span class="stock-val">${p.stock}</span> Pcs`;
                                }
                            }
                        }
                    });
                }
            } catch (err) {
                console.error("Realtime stock sync error:", err);
            }
        }

        // Auto Poll setiap 3 detik
        setInterval(fetchRealtimeStock, 3000);
    </script>
</body>
</html>
