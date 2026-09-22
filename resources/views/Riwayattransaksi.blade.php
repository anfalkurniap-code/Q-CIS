<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK Mart - Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-sm bg-gray-50 min-h-screen flex flex-col justify-between shadow-lg relative pb-20">
        
        <div>
            <!-- Header Top Bar -->
            <header class="bg-white px-5 py-4 flex justify-between items-center border-b border-gray-100">
                <h1 class="text-emerald-600 font-bold text-lg">Q-CIS SMK Mart</h1>
            </header>

            <!-- Main Content -->
            <main class="px-5 pt-5">
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Riwayat Transaksi</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Pantau pengeluaran dan saldo Anda bulan ini.</p>
                </div>

                <!-- Transaction List Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 p-3 shadow-sm">
                    
                    <div id="transaction-list" class="divide-y divide-gray-100">
                        
                        {{-- MENAMPILKAN DATA TRANSAKSI DARI DATABASE --}}
                        @forelse($riwayat ?? [] as $item)
                        <a href="{{ Route::has('transaksi.detail') ? route('transaksi.detail', $item->id) : url('/transaksi/'.$item->id) }}" 
                           class="flex items-center justify-between py-3 px-1.5 hover:bg-emerald-50/40 rounded-xl transition group">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 group-hover:bg-emerald-200 transition">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm group-hover:text-emerald-700 transition">
                                        {{-- Menggunakan optional chaining (?->) agar aman jika details null --}}
                                        {{ $item->details?->first()?->product_name ?? 'Pembayaran Mart' }}
                                        
                                        @if(($item->details?->count() ?? 0) > 1)
                                            <span class="text-xs text-gray-400 font-normal">
                                                (+{{ $item->details->count() - 1 }} lainnya)
                                            </span>
                                        @endif
                                    </h3>
                                    <div class="flex items-center space-x-2 mt-0.5">
                                        <span class="text-[10px] text-gray-400">
                                            @if(!empty($item->created_at))
                                                {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') ?: \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                            @else
                                                {{ $item->waktu ?? '-' }}
                                            @endif
                                        </span>
                                        <span class="text-[8px] font-semibold text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded tracking-wider uppercase">
                                            {{ $item->payment_method ?? ($item->kategori ?? 'TUNAI') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Nominal pengeluaran & action hint -->
                            <div class="text-right">
                                <span class="text-rose-500 font-semibold text-sm block">- Rp {{ number_format($item->total_price ?? 0, 0, ',', '.') }}</span>
                                <span class="text-[10px] text-gray-400 group-hover:text-emerald-600 flex items-center justify-end gap-1 mt-0.5">
                                    Detail <i class="fa-solid fa-chevron-right text-[8px]"></i>
                                </span>
                            </div>
                        </a>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fa-solid fa-receipt text-xl"></i>
                                </div>
                                <p class="text-xs font-semibold text-gray-600">Belum ada riwayat transaksi</p>
                                <p class="text-[10px] text-gray-400 mt-0.5">Transaksi belanja kasir Anda akan muncul di sini.</p>
                            </div>
                        @endforelse

                        <!-- Dummy Top-Up Saldo Pelengkap -->
                        <div class="flex items-center justify-between py-3 px-1.5">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-wallet"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm">Top-Up Saldo</h3>
                                    <div class="flex items-center space-x-2 mt-0.5">
                                        <span class="text-[10px] text-gray-400">10 Okt 2023</span>
                                        <span class="text-[8px] font-semibold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded tracking-wider uppercase">TOP-UP</span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-emerald-500 font-semibold text-sm">+ Rp 50.000</span>
                        </div>

                    </div>

                </div>
            </main>
        </div>

        <!-- Bottom Navigation Bar -->
        <nav class="fixed bottom-0 max-w-sm w-full bg-white border-t border-gray-200 py-2 px-6 flex justify-between items-center z-10">
            <a href="{{ Route::has('dashboard.kasir') ? route('dashboard.kasir') : url('/HalamanDepanKasir') }}" class="flex flex-col items-center text-gray-500 hover:text-emerald-600 text-xs">
                <i class="fa-solid fa-house text-base mb-1"></i>
                <span>Home</span>
            </a>
            
            <a href="{{ Route::has('halaman.shop') ? route('halaman.shop') : url('/shop') }}" class="flex flex-col items-center text-gray-500 hover:text-emerald-600 text-xs">
                <i class="fa-solid fa-bag-shopping text-base mb-1"></i>
                <span>Shop</span>
            </a>
            
            <a href="{{ Route::has('riwayat.transaksi') ? route('riwayat.transaksi') : url('/Riwayattransaksi') }}" class="flex flex-col items-center text-white text-xs">
                <div class="bg-emerald-600 px-4 py-2 rounded-xl flex flex-col items-center">
                    <i class="fa-solid fa-receipt text-base mb-0.5"></i>
                    <span class="font-medium text-[11px]">Trans</span>
                </div>
            </a>
            
            <a href="{{ Route::has('profile.index') ? route('profile.index') : (Route::has('halaman.profile') ? route('halaman.profile') : url('/HalamanProfile')) }}" class="flex flex-col items-center text-gray-500 hover:text-emerald-600 text-xs">
                <i class="fa-regular fa-user text-base mb-1"></i>
                <span>Profile</span>
            </a>
        </nav>

    </div>

</body>
</html>