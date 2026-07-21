<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS - Quick Inventory Information System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAFAFA;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen p-4">

    <div class="w-full max-w-[390px] bg-white border border-gray-100 shadow-sm rounded-3xl overflow-hidden p-6 flex flex-col gap-6">
        
        <header class="flex justify-between items-center w-full">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-[#E8F5E9] border border-[#A5D6A7] rounded-md flex items-center justify-center">
                    <div class="w-2 h-2 bg-[#2E7D32] rounded-[2px]"></div>
                </div>
                <span class="text-base font-bold text-[#1A2E22]">Q-CIS</span>
            </div>
            <div class="flex items-center gap-3">
                <button class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>
                <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden border border-gray-200">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=100&h=100" alt="Profile" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <section class="text-center my-2">
            <h1 class="text-[26px] font-extrabold text-[#1A2E22] leading-tight tracking-wide">
                Selamat Datang di<br>Q-CIS
            </h1>
            <p class="text-[11px] text-[#616161] mt-3 font-medium leading-relaxed px-4">
                Quick Inventory Information System<br>
                for <span class="font-bold text-gray-800">SMK MART - SMKN 1 KEBUN TEBU</span>
            </p>
        </section>

        <main class="flex flex-col gap-4">

            <div class="border border-[#F0F0F0] rounded-2xl p-5 flex flex-col gap-4 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.01)]">
                <div class="w-10 h-10 bg-[#1D2D24] rounded-lg flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-[18px] font-bold text-[#111] mb-1.5">Sistem Kasir</h2>
                    <p class="text-[12px] text-[#757575] leading-relaxed">
                        Kelola transaksi pelanggan real-time dengan antarmuka POS yang intuitif.
                    </p>
                </div>
                <a href="{{ url('/loginKasir') }}" class="w-full bg-[#F7F9FA] hover:bg-[#EEF1F3] transition-colors rounded-xl py-2.5 text-center text-[12px] font-bold text-[#2C3E50] flex items-center justify-center gap-1.5">
                    Masuk 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="border border-[#F0F0F0] rounded-2xl p-5 flex flex-col gap-4 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.01)]">
                <div class="w-10 h-10 bg-[#A7F3D0] rounded-lg flex items-center justify-center text-[#065F46]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-[18px] font-bold text-[#111] mb-1.5">Kepala Toko</h2>
                    <p class="text-[12px] text-[#757575] leading-relaxed">
                        Dashboard analitik lengkap untuk memantau performa penjualan harian, laporan laba rugi, dan manajemen staf.
                    </p>
                </div>
                <a href="#" class="w-full bg-[#F7F9FA] hover:bg-[#EEF1F3] transition-colors rounded-xl py-2.5 text-center text-[12px] font-bold text-[#2C3E50] flex items-center justify-center gap-1.5">
                    Masuk 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <div class="border border-[#F0F0F0] rounded-2xl p-5 flex flex-col gap-4 bg-white shadow-[0_2px_8px_rgba(0,0,0,0.01)]">
                <div class="w-10 h-10 bg-[#24332A] rounded-lg flex items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-[18px] font-bold text-[#111] mb-1.5"> Gudang</h2>
                    <p class="text-[12px] text-[#757575] leading-relaxed">
                        Optimalkan stok barang, manajemen supplier, dan pantau keluar masuknya inventaris dengan presisi tinggi.
                    </p>
                </div>
                <a href="{{ url('/LoginGudang') }}" class="w-full bg-[#F7F9FA] hover:bg-[#EEF1F3] transition-colors rounded-xl py-2.5 text-center text-[12px] font-bold text-[#2C3E50] flex items-center justify-center gap-1.5">
                    Masuk 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

        </main>
    </div>

</body>
</html>