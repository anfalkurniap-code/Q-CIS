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

        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            .mobile-frame {
                max-width: 100% !important;
                height: auto !important;
                max-height: none !important;
                border: none !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                overflow: visible !important;
            }
            .print-container {
                padding: 20px !important;
            }
        }

        .print-only {
            display: none;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex justify-center items-center p-0 md:p-4">

    <!-- Container Frame HP / Laptop -->
    <div class="mobile-frame w-full max-w-sm md:max-w-md bg-[#f8faf9] h-screen md:h-[820px] md:max-h-[900px] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-start overflow-hidden">
        
        <!-- Printable Document Output (Only Visible in Window.Print) -->
        <div class="print-only p-6 bg-white text-slate-800">
            <!-- Kop Surat -->
            <div class="text-center border-b-2 border-[#064e3b] pb-3 mb-4">
                <h1 class="text-2xl font-extrabold text-[#064e3b] tracking-wider uppercase">Q-CIS SMK MART</h1>
                <p class="text-xs text-slate-600 font-medium">Laporan Rekapitulasi Transaksi & Financial Summary</p>
                <p class="text-[10px] text-slate-500">SMK Negeri kepala Toko • Email: info@smkmart.sch.id</p>
            </div>

            <!-- Periode & Meta Info -->
            <div class="flex justify-between items-center text-xs mb-4 text-slate-700">
                <div>
                    <strong>Periode Laporan:</strong> 
                    @if(!empty($startDate) || !empty($endDate))
                        {{ !empty($startDate) ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Awal' }}
                        - 
                        {{ !empty($endDate) ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Hari Ini' }}
                    @else
                        Semua Periode
                    @endif
                </div>
                <div>
                    <strong>Dicetak Tanggal:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
                </div>
            </div>

            <!-- Summary Table (5 Columns) -->
            <table class="w-full border-collapse border border-slate-200 mb-6 text-xs">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 font-bold uppercase text-[10px]">
                        <th class="border border-slate-200 p-2 text-left">TOTAL BARANG MASUK</th>
                        <th class="border border-slate-200 p-2 text-left">TOTAL BARANG KELUAR</th>
                        <th class="border border-slate-200 p-2 text-left">TOTAL UANG MASUK</th>
                        <th class="border border-slate-200 p-2 text-left">TOTAL UANG KELUAR (MODAL)</th>
                        <th class="border border-slate-200 p-2 text-left">LABA / RUGI NETTO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-slate-200 p-2 font-bold text-blue-600 text-sm">{{ number_format($summary['total_barang_masuk'] ?? 0) }} Unit</td>
                        <td class="border border-slate-200 p-2 font-bold text-blue-600 text-sm">{{ number_format($summary['total_barang_keluar'] ?? 0) }} Unit</td>
                        <td class="border border-slate-200 p-2 font-bold text-emerald-600 text-sm">Rp{{ number_format($summary['total_uang_masuk'] ?? 0, 0, ',', '.') }}</td>
                        <td class="border border-slate-200 p-2 font-bold text-rose-600 text-sm">Rp{{ number_format($summary['total_uang_keluar'] ?? 0, 0, ',', '.') }}</td>
                        <td class="border border-slate-200 p-2 font-bold text-sm {{ ($summary['laba_rugi_netto'] ?? 0) >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                            Rp{{ number_format($summary['laba_rugi_netto'] ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Section I: Detail Rincian Barang Masuk (Gudang) -->
            <h2 class="text-sm font-bold text-[#064e3b] mb-2">I. Detail Rincian Barang Masuk (Gudang)</h2>
            <table class="w-full border-collapse border border-slate-200 mb-6 text-xs">
                <thead>
                    <tr class="bg-[#064e3b] text-white font-bold uppercase text-[9px]">
                        <th class="border border-slate-300 p-1.5 text-center w-8">NO</th>
                        <th class="border border-slate-300 p-1.5 text-left">TANGGAL</th>
                        <th class="border border-slate-300 p-1.5 text-left">NAMA BARANG</th>
                        <th class="border border-slate-300 p-1.5 text-right">JUMLAH</th>
                        <th class="border border-slate-300 p-1.5 text-right">HARGA BELI</th>
                        <th class="border border-slate-300 p-1.5 text-right">HARGA JUAL</th>
                        <th class="border border-slate-300 p-1.5 text-center">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allBarangMasuk ?? $barangMasuk ?? [] as $index => $item)
                        <tr class="{{ $loop->even ? 'bg-slate-50' : '' }}">
                            <td class="border border-slate-200 p-1.5 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-200 p-1.5">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="border border-slate-200 p-1.5 font-medium">{{ $item->nama_barang }}</td>
                            <td class="border border-slate-200 p-1.5 text-right">{{ number_format($item->jumlah ?? 0) }}</td>
                            <td class="border border-slate-200 p-1.5 text-right">Rp{{ number_format($item->purchase_price ?? $item->harga ?? 0, 0, ',', '.') }}</td>
                            <td class="border border-slate-200 p-1.5 text-right">Rp{{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                            <td class="border border-slate-200 p-1.5 text-center">
                                @if(($item->status ?? 'pending') == 'pending')
                                    <span class="inline-block px-1.5 py-0.5 text-[8px] font-bold bg-amber-100 text-amber-700 rounded uppercase">Menunggu</span>
                                @elseif($item->status == 'approved')
                                    <span class="inline-block px-1.5 py-0.5 text-[8px] font-bold bg-emerald-100 text-emerald-700 rounded uppercase">Disetujui</span>
                                @else
                                    <span class="inline-block px-1.5 py-0.5 text-[8px] font-bold bg-rose-100 text-rose-700 rounded uppercase">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border border-slate-200 p-3 text-center text-slate-400">Tidak ada data barang masuk pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Section II: Detail Rincian Barang Keluar (Penjualan Kasir) -->
            <h2 class="text-sm font-bold text-[#064e3b] mb-2">II. Detail Rincian Barang Keluar (Penjualan Kasir)</h2>
            <table class="w-full border-collapse border border-slate-200 mb-6 text-xs">
                <thead>
                    <tr class="bg-[#064e3b] text-white font-bold uppercase text-[9px]">
                        <th class="border border-slate-300 p-1.5 text-center w-8">NO</th>
                        <th class="border border-slate-300 p-1.5 text-left">INVOICE</th>
                        <th class="border border-slate-300 p-1.5 text-left">TANGGAL</th>
                        <th class="border border-slate-300 p-1.5 text-left">DETAIL PRODUK</th>
                        <th class="border border-slate-300 p-1.5 text-center">METODE BAYAR</th>
                        <th class="border border-slate-300 p-1.5 text-right">TOTAL TRANSAKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allBarangKeluar ?? $barangKeluar ?? [] as $index => $trx)
                        <tr class="{{ $loop->even ? 'bg-slate-50' : '' }}">
                            <td class="border border-slate-200 p-1.5 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-200 p-1.5 font-bold">{{ $trx->invoice_number }}</td>
                            <td class="border border-slate-200 p-1.5">{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="border border-slate-200 p-1.5">
                                @foreach($trx->details as $detail)
                                    <div>• {{ $detail->product_name }} ({{ number_format($detail->quantity) }}x @ Rp{{ number_format($detail->price, 0, ',', '.') }})</div>
                                @endforeach
                            </td>
                            <td class="border border-slate-200 p-1.5 text-center lowercase">{{ $trx->payment_method ?? 'cash' }}</td>
                            <td class="border border-slate-200 p-1.5 text-right font-bold">Rp{{ number_format($trx->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border border-slate-200 p-3 text-center text-slate-400">Tidak ada data barang keluar pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Footer Tanda Tangan -->
            <div class="mt-8 text-right text-xs text-slate-700">
                <p>Mengetahui,</p>
                <div class="h-16"></div>
                <p class="font-bold">Kepala Toko Q-CIS SMK MART</p>
            </div>
        </div>

        <!-- Header & Nav Top (Bagian Atas Tetap) -->
        <div class="p-4 pb-2 space-y-3 bg-[#f8faf9] shrink-0 no-print">
            <div class="flex items-center justify-between text-[#064e3b]">
                <div class="flex items-center gap-2 font-bold text-sm">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Q-CIS SMK MART</span>
                </div>
                <!-- Tombol Printer / Cetak Laporan (Header Right Side) -->
                <div class="relative">
                    <button id="printerMenuBtn" type="button" onclick="togglePrintMenu()" class="p-1.5 rounded-xl bg-emerald-50 text-[#064e3b] hover:bg-emerald-100 transition focus:outline-none border border-emerald-200/60 shadow-sm flex items-center justify-center gap-1" title="Cetak / Print Laporan">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menu Cetak Options -->
                    <div id="printDropdownMenu" class="hidden absolute right-0 mt-2 w-44 bg-white rounded-2xl shadow-xl border border-slate-200 py-1.5 z-50">
                        <div class="px-3 py-1.5 border-b border-slate-100">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Opsi Cetak Laporan</span>
                        </div>
                        <a href="{{ route('report.pdf', array_merge(request()->all(), ['start_date' => $startDate ?? request('start_date'), 'end_date' => $endDate ?? request('end_date')])) }}" target="_blank" onclick="closePrintMenu()" class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-rose-50 hover:text-rose-700 transition">
                            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Download PDF</span>
                        </a>
                        <button type="button" onclick="closePrintMenu(); window.print();" class="w-full flex items-center gap-2 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-emerald-50 hover:text-[#064e3b] transition text-left">
                            <svg class="w-4 h-4 text-[#064e3b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            <span>Print Browser</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Title & Subtitle -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-lg font-extrabold text-slate-900 tracking-tight leading-tight">
                        {{ ($activeTab ?? request('tab', 'masuk')) == 'keluar' ? 'Laporan Barang Keluar' : 'Persetujuan Barang Masuk' }}
                    </h1>
                    <p class="text-[11px] text-slate-500 mt-0.5">
                        {{ ($activeTab ?? request('tab', 'masuk')) == 'keluar' ? 'Riwayat transaksi & penjualan barang oleh kasir.' : 'Setujui atau tolak barang yang diajukan petugas gudang.' }}
                    </p>
                </div>
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



            <!-- Filter Rentang Tanggal (Date Range Filter) & Search -->
            <form method="GET" action="{{ route('report.kepalatoko') }}" class="space-y-2 bg-white p-3 rounded-2xl border border-slate-200 shadow-sm">
                <input type="hidden" name="tab" value="{{ request('tab', 'masuk') }}">
                
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ $startDate ?? request('start_date') }}" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ $endDate ?? request('end_date') }}" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:border-emerald-600">
                    </div>
                </div>

                <!-- Search Input -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ request('tab') == 'keluar' ? 'Cari no. transaksi / barang...' : 'Cari nama barang...' }}" class="w-full pl-8 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-600">
                </div>

                <!-- Action Buttons: Filter & Reset -->
                <div class="flex items-center gap-2 pt-0.5">
                    <button type="submit" class="flex-1 bg-[#064e3b] hover:bg-[#04392b] text-white text-xs font-bold py-1.5 rounded-lg transition shadow-sm">
                        Filter Tanggal
                    </button>
                    @if(request()->filled('start_date') || request()->filled('end_date') || request()->filled('date') || request()->filled('search'))
                        <a href="{{ route('report.kepalatoko', ['tab' => request('tab', 'masuk')]) }}" class="px-3 py-1.5 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold rounded-lg transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>



        <!-- Tabs Nav -->
        <div class="px-4 shrink-0 no-print">
            <div class="flex border-b border-slate-200 text-xs">
                <a href="{{ route('report.kepalatoko', ['tab' => 'masuk', 'search' => request('search'), 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="w-1/2 py-2 text-center font-bold {{ request('tab', 'masuk') == 'masuk' ? 'text-[#064e3b] border-b-2 border-[#064e3b]' : 'text-slate-400 hover:text-slate-600' }}">
                    Barang Masuk<br><span class="font-normal text-[11px] {{ request('tab', 'masuk') == 'masuk' ? 'text-slate-500' : 'text-slate-400' }}">(Gudang)</span>
                </a>
                <a href="{{ route('report.kepalatoko', ['tab' => 'keluar', 'search' => request('search'), 'start_date' => $startDate, 'end_date' => $endDate]) }}" class="w-1/2 py-2 text-center font-semibold {{ request('tab') == 'keluar' ? 'text-[#064e3b] border-b-2 border-[#064e3b]' : 'text-slate-400 hover:text-slate-600' }}">
                    Barang Keluar<br><span class="font-normal text-[11px] {{ request('tab') == 'keluar' ? 'text-slate-500' : 'text-slate-400' }}">(Kasir)</span>
                </a>
            </div>
        </div>

        <!-- Scrollable Item List -->
        <div class="px-4 pt-3 pb-24 space-y-3 overflow-y-auto flex-1 print-container no-print">
            
            @if(request('tab') == 'keluar')
                {{-- LIST BARANG KELUAR / PENJUALAN KASIR --}}
                @forelse($barangKeluar ?? [] as $trx)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-3.5 space-y-2.5">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                            <div>
                                <span class="text-[10px] font-mono text-slate-400 block">{{ $trx->invoice_number }}</span>
                                <span class="text-[11px] font-bold text-slate-800">{{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y • H:i') }}</span>
                            </div>
                            <span class="inline-block text-[10px] font-bold bg-emerald-100 text-emerald-800 px-2.5 py-0.5 rounded-full uppercase tracking-wider">
                                {{ $trx->payment_method ?? 'CASH' }}
                            </span>
                        </div>

                        {{-- Item Details --}}
                        <div class="space-y-1.5 pt-0.5">
                            @foreach($trx->details as $detail)
                                <div class="flex justify-between items-center text-xs">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block no-print"></span>
                                        <span class="font-semibold text-slate-700">{{ $detail->product_name }}</span>
                                        <span class="text-[11px] text-slate-400">x{{ number_format($detail->quantity) }}</span>
                                    </div>
                                    <span class="font-bold text-slate-800">Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Total Header --}}
                        <div class="flex justify-between items-center pt-2 border-t border-slate-100 text-xs">
                            <span class="font-bold text-slate-500">Total Penjualan:</span>
                            <span class="font-extrabold text-emerald-600 text-sm">Rp{{ number_format($trx->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-xs text-slate-400">Belum ada data barang keluar (penjualan kasir).</p>
                    </div>
                @endforelse
            @else
                {{-- LIST BARANG MASUK / GUDANG --}}
                @forelse($barangMasuk ?? [] as $item)
                    <div class="bg-white rounded-2xl shadow-sm border {{ ($item->status ?? 'pending') == 'pending' ? 'border-amber-200' : (($item->status ?? '') == 'approved' ? 'border-emerald-200' : 'border-rose-200') }} overflow-hidden">
                        
                        {{-- Foto Produk (jika ada) --}}
                        @if(!empty($item->image))
                            <div class="w-full h-28 bg-slate-100 overflow-hidden no-print">
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
                                <div class="flex flex-col gap-1.5 shrink-0 no-print">
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
            @endif

        </div>

        <!-- Bottom Navigation Bar -->
        <div class="absolute bottom-0 inset-x-0 bg-white border-t border-slate-100 px-3 py-2 flex items-center justify-around z-20 no-print">
            <!-- 1. Dashboard -->
            <a href="{{ route('dashboard.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Dashboard</span>
            </a>

            <!-- 2. Stok Barang -->
            <a href="{{ route('stok.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-slate-400 hover:text-[#064e3b] transition">
                <div class="p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-[10px] font-medium">Stok Barang</span>
            </a>

            <!-- 3. Reports (Aktif) -->
            <a href="{{ route('report.kepalatoko') }}" class="flex flex-col items-center gap-0.5 text-[#064e3b]">
                <div class="px-3 py-1 rounded-xl bg-[#064e3b] text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-bold">Reports</span>
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

    <script>
        function togglePrintMenu() {
            const menu = document.getElementById('printDropdownMenu');
            if (menu) {
                menu.classList.toggle('hidden');
            }
        }
        function closePrintMenu() {
            const menu = document.getElementById('printDropdownMenu');
            if (menu) {
                menu.classList.add('hidden');
            }
        }
        document.addEventListener('click', function(event) {
            const btn = document.getElementById('printerMenuBtn');
            const menu = document.getElementById('printDropdownMenu');
            if (menu && btn && !btn.contains(event.target) && !menu.contains(event.target)) {
                closePrintMenu();
            }
        });
    </script>
</body>
</html>