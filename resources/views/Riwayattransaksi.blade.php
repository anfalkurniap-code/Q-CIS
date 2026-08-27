<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK Mart - Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
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

                <!-- Export Data Button -->
                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-4 rounded-xl flex items-center justify-center space-x-2 text-xs transition shadow-sm mb-5">
                    <i class="fa-solid fa-download"></i>
                    <span>Ekspor Data</span>
                </button>

                <!-- Transaction List Card -->
                <div class="bg-white rounded-2xl border border-gray-200/80 p-3 shadow-sm">
                    
                    <div id="transaction-list">
                        
                        {{-- MENAMPILKAN DATA TRANSAKSI DARI SESSION --}}
                        @forelse($riwayat as $item)
                        <div class="flex items-center justify-between py-3 px-1 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-red-100 text-red-500 flex items-center justify-center">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 text-sm">
                                        {{ $item['cart_data'][0]['nama'] ?? 'Pembayaran Mart' }}
                                        @if(count($item['cart_data']) > 1)
                                            <span class="text-xs text-gray-400 font-normal">(+{{ count($item['cart_data']) - 1 }} lainnya)</span>
                                        @endif
                                    </h3>
                                    <div class="flex items-center space-x-2 mt-0.5">
                                        <span class="text-[10px] text-gray-400">{{ $item['waktu'] }}</span>
                                        <span class="text-[8px] font-semibold text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded tracking-wider uppercase">
                                            {{ $item['kategori'] ?? 'KONSUMSI' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="text-red-500 font-semibold text-sm">- Rp {{ number_format($item['total_price'], 0, ',', '.') }}</span>
                        </div>
                        @empty
                        <div class="text-center py-6 text-xs text-gray-400">
                            Belum ada riwayat transaksi.
                        </div>
                        @endforelse

                        <!-- Dummy Top-Up Saldo untuk Pelengkap -->
                        <div class="flex items-center justify-between py-3 px-1 border-b border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-500 flex items-center justify-center">
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
            <a href="{{ route('dashboard.kasir') }}" class="flex flex-col items-center text-gray-500 hover:text-emerald-600 text-xs">
                <i class="fa-solid fa-house text-base mb-1"></i>
                <span>Home</span>
            </a>
            
            <a href="{{ route('halaman.shop') }}" class="flex flex-col items-center text-gray-500 hover:text-emerald-600 text-xs">
                <i class="fa-solid fa-bag-shopping text-base mb-1"></i>
                <span>Shop</span>
            </a>
            
            <a href="{{ route('riwayat.transaksi') }}" class="flex flex-col items-center text-white text-xs">
                <div class="bg-emerald-600 px-4 py-2 rounded-xl flex flex-col items-center">
                    <i class="fa-solid fa-receipt text-base mb-0.5"></i>
                    <span class="font-medium text-[11px]">Trans</span>
                </div>
            </a>
            
            <a href="{{ url('/HalamanProfile') }}" class="flex flex-col items-center text-gray-500 hover:text-emerald-600 text-xs">
                <i class="fa-regular fa-user text-base mb-1"></i>
                <span>Profile</span>
            </a>
        </nav>

    </div>

</body>
</html>