<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS Mobile - Riwayat Transaksi Barang Masuk</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Roboto+Mono:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-custom { font-family: 'Roboto Mono', monospace; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-200 min-h-screen flex items-center justify-center p-0 sm:p-4">

    <!-- Container Tampilan Mobile Presisi Gambar -->
    <div class="mobile-container w-full max-w-[420px] bg-[#f8fafb] min-h-screen sm:min-h-[840px] shadow-2xl relative flex flex-col justify-between overflow-hidden sm:rounded-3xl border border-slate-200">

        <!-- CONTENT SECTION -->
        <div class="overflow-y-auto pb-28">

            <!-- Header Title dengan Tombol Kembali -->
            <header class="bg-white px-5 py-4 flex items-center gap-3 border-b border-slate-100 sticky top-0 z-20 shadow-sm">
                <a href="{{ Route::has('kelola.gudang') ? route('kelola.gudang') : url('/kelola-gudang') }}" class="text-[#024d35] hover:text-[#013827] text-lg transition">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="text-lg font-bold text-[#024d35]">Riwayat Transaksi</h1>
            </header>

            <!-- Main Content Container -->
            <main class="p-4 space-y-4">

                <!-- Input Pencarian & Filter Rentang Hari -->
                <div class="space-y-2">
                    <div class="relative flex items-center">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-sm"></i>
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Cari transaksi (Nama, Supplier)..." 
                            class="w-full bg-white border border-slate-200 text-xs font-medium text-slate-700 pl-9 pr-4 py-3 rounded-xl focus:outline-none focus:ring-1 focus:ring-[#024d35] placeholder:text-slate-400 shadow-sm"
                        />
                    </div>

                    <!-- Dropdown Filter Rentang Hari -->
                    <div class="relative">
                        <i class="fa-solid fa-calendar-days absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <select 
                            id="dateFilter"
                            class="w-full bg-white border border-slate-200 text-xs font-semibold text-slate-600 pl-9 pr-8 py-2.5 rounded-xl focus:outline-none focus:ring-1 focus:ring-[#024d35] shadow-sm appearance-none cursor-pointer"
                        >
                            <option value="all">Semua Riwayat</option>
                            <option value="today">Hari Ini</option>
                            <option value="7days">7 Hari Terakhir</option>
                            <option value="30days">30 Hari Terakhir</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-[10px] pointer-events-none"></i>
                    </div>
                </div>

                <!-- Sub-Judul Section -->
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-bold text-slate-700">Barang Masuk (Inbound)</h2>
                    <span class="text-[10px] font-semibold text-slate-400" id="transactionCount">
                        Total: {{ count($riwayatProduk ?? $transactions ?? []) }} Transaksi
                    </span>
                </div>

                <!-- Product Inbound List -->
                <div class="space-y-3" id="transactionList">
                    @php 
                        $grandTotalPengeluaran = 0; 
                        $totalStokMasuk = 0;
                        $list = $riwayatProduk ?? $transactions ?? [];
                    @endphp

                    @forelse($list as $item)
                        @php
                            $hargaBeli = $item->purchase_price ?? $item->price ?? $item->selling_price ?? 0;
                            $totalHargaItem = $hargaBeli * $item->stock;
                            $grandTotalPengeluaran += $totalHargaItem;
                            $totalStokMasuk += $item->stock;
                            
                            // Ambil tanggal mentah format ISO (YYYY-MM-DD) untuk komparasi JavaScript
                            $dateRaw = \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
                        @endphp
                        <div 
                            class="transaction-item bg-white rounded-xl p-3.5 border border-slate-200/90 shadow-sm relative"
                            data-date="{{ $dateRaw }}"
                            data-total="{{ $totalHargaItem }}"
                            data-stock="{{ $item->stock }}"
                        >
                            
                            <!-- Baris Atas: Nama Barang & Jumlah Stok Masuk -->
                            <div class="flex justify-between items-start mb-0.5">
                                <h3 class="item-title text-sm font-extrabold text-slate-800 leading-tight">
                                    {{ $item->name ?? $item->product_name }}
                                </h3>
                                <div class="text-right">
                                    <span class="text-xs font-bold text-emerald-600 font-mono-custom">
                                        +{{ $item->stock }} <span class="text-[10px] font-normal text-emerald-600">pcs</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Baris Tengah: Nama Supplier & Tanggal Transaksi -->
                            <div class="flex justify-between items-center text-[10px] text-slate-400 font-medium mb-1.5">
                                <span class="supplier-name font-semibold text-slate-500">
                                    {{ $item->supplier_name ?? 'PT. Indo Perkasa' }}
                                </span>
                                <span>
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                                </span>
                            </div>

                            <!-- Baris Subtotal Pembelian per Item -->
                            <div class="flex justify-between items-center text-[11px] bg-slate-50 px-2.5 py-1 rounded-lg mb-2">
                                <span class="text-slate-400 font-medium text-[10px]">Total Belanja</span>
                                <span class="font-extrabold text-slate-700">Rp {{ number_format($totalHargaItem, 0, ',', '.') }}</span>
                            </div>

                            <!-- Baris Bawah: Badge Status & Nomor PO -->
                            <div class="flex justify-between items-center pt-1 border-t border-slate-50">
                                <span class="bg-[#00f0aa] text-[#024d35] text-[9px] font-extrabold px-2 py-0.5 rounded uppercase tracking-wider">
                                    DITERIMA
                                </span>
                                <span class="text-[10px] font-medium text-slate-400 font-mono-custom">
                                    PO-{{ \Carbon\Carbon::parse($item->created_at)->format('Ymd') }}-{{ sprintf('%02d', $item->id) }}
                                </span>
                            </div>

                        </div>
                    @empty
                        <div id="emptyState" class="text-center py-10 bg-white rounded-xl border border-dashed border-slate-300">
                            <i class="fa-solid fa-receipt text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs font-bold text-slate-500">Belum ada riwayat barang masuk.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Fallback jika filter tidak menemukan data -->
                <div id="noMatchState" class="hidden text-center py-10 bg-white rounded-xl border border-dashed border-slate-300">
                    <i class="fa-solid fa-filter-circle-xmark text-3xl text-slate-300 mb-2"></i>
                    <p class="text-xs font-bold text-slate-500">Tidak ada transaksi pada rentang waktu ini.</p>
                </div>

            </main>
        </div>

        <!-- FOOTER SECTION: RINGKASAN UANG DI PALING BAWAH -->
        <div class="absolute bottom-0 left-0 right-0 bg-white border-t border-slate-200 p-4 z-30 shadow-lg">
            <!-- Card Total Pengeluaran -->
            <div class="bg-emerald-50 border border-emerald-200 p-3.5 rounded-xl flex justify-between items-center">
                <div>
                    <span class="text-[9px] font-black text-emerald-700 uppercase tracking-wider block">TOTAL UANG DIKELUARKAN</span>
                    <span class="text-xs text-slate-500 font-medium" id="totalStokText">dari {{ $totalStokMasuk }} total pcs barang masuk</span>
                </div>
                <div class="text-right">
                    <span class="text-base font-black text-[#024d35] font-mono-custom" id="grandTotalText">
                        Rp {{ number_format($grandTotalPengeluaran, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

    </div>

    <!-- Script Live Search & Date Filter -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const dateFilter = document.getElementById('dateFilter');
        const items = document.querySelectorAll('#transactionList .transaction-item');
        const noMatchState = document.getElementById('noMatchState');
        const transactionCount = document.getElementById('transactionCount');
        const grandTotalText = document.getElementById('grandTotalText');
        const totalStokText = document.getElementById('totalStokText');

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number).replace('Rp', 'Rp ');
        }

        function filterTransactions() {
            const searchValue = searchInput.value.toLowerCase();
            const filterValue = dateFilter.value;
            
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            let visibleCount = 0;
            let currentGrandTotal = 0;
            let currentTotalStock = 0;

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                const itemDateStr = item.getAttribute('data-date');
                const itemTotal = parseFloat(item.getAttribute('data-total')) || 0;
                const itemStock = parseInt(item.getAttribute('data-stock')) || 0;

                const itemDate = new Date(itemDateStr);
                itemDate.setHours(0, 0, 0, 0);

                // Hitung selisih hari
                const diffTime = today - itemDate;
                const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));

                let matchesSearch = text.includes(searchValue);
                let matchesDate = false;

                if (filterValue === 'all') {
                    matchesDate = true;
                } else if (filterValue === 'today') {
                    matchesDate = (diffDays === 0);
                } else if (filterValue === '7days') {
                    matchesDate = (diffDays >= 0 && diffDays <= 7);
                } else if (filterValue === '30days') {
                    matchesDate = (diffDays >= 0 && diffDays <= 30);
                }

                if (matchesSearch && matchesDate) {
                    item.style.display = 'block';
                    visibleCount++;
                    currentGrandTotal += itemTotal;
                    currentTotalStock += itemStock;
                } else {
                    item.style.display = 'none';
                }
            });

            // Tampilkan pesan jika tidak ada data yang sesuai
            if (noMatchState) {
                if (visibleCount === 0 && items.length > 0) {
                    noMatchState.classList.remove('hidden');
                } else {
                    noMatchState.classList.add('hidden');
                }
            }

            // Update statistik di UI secara dinamis
            if (transactionCount) {
                transactionCount.textContent = `Total: ${visibleCount} Transaksi`;
            }
            if (grandTotalText) {
                grandTotalText.textContent = formatRupiah(currentGrandTotal);
            }
            if (totalStokText) {
                totalStokText.textContent = `dari ${currentTotalStock} total pcs barang masuk`;
            }
        }

        searchInput.addEventListener('keyup', filterTransactions);
        dateFilter.addEventListener('change', filterTransactions);
    </script>
</body>
</html>