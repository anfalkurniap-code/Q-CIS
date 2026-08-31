<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Aplikasi</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN (untuk Ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 flex justify-center items-center min-h-screen p-4">

    <!-- Container Utama (Ukuran Tampilan Mobile) -->
    <div class="w-full max-w-sm bg-emerald-50/20 min-h-screen p-5 flex flex-col justify-between rounded-xl shadow-lg border border-slate-100">
        
        <div>
            <!-- Header Navigasi -->
            <div class="flex items-center space-x-3 mb-6">
                <button class="text-emerald-600 hover:text-emerald-700 text-xl font-bold">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <h1 class="text-xl font-bold text-emerald-600">Tentang Aplikasi</h1>
            </div>

            <!-- Logo dan Versi -->
            <div class="flex flex-col items-center text-center my-6">
                <!-- Icon Logo App -->
                <div class="w-20 h-20 bg-emerald-600 rounded-3xl flex items-center justify-center shadow-lg shadow-emerald-600/30 mb-4 p-3 border-4 border-emerald-100">
                    <i class="fa-solid fa-bag-shopping text-4xl text-white"></i>
                </div>
                <!-- Title & Version -->
                <h2 class="text-xl font-extrabold text-slate-800">Q-CIS SMK Mart</h2>
                <span class="text-xs font-bold tracking-wider text-emerald-500 mt-1">VERSION 2.4.0</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Build ID: 2024.08.15-PROD</span>
            </div>

            <!-- Kartu Deskripsi -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 text-xs text-slate-600 leading-relaxed text-left mb-6">
                Sistem Informasi Manajemen Kantin Sekolah yang Modern dan Terintegrasi dengan standar Academic Precision. Dirancang untuk meningkatkan efisiensi transaksi dan transparansi keuangan di lingkungan sekolah.
            </div>

            <!-- Seksi Informasi Hukum & Bantuan -->
            <div class="mb-6">
                <p class="text-xs font-semibold text-slate-500 mb-2">Informasi Hukum & Bantuan</p>
                
                <div class="bg-white rounded-xl shadow-sm border border-slate-100 divide-y divide-slate-100">
                    <!-- Item 1 -->
                    <a href="#" class="flex items-center justify-between p-3.5 hover:bg-slate-50 transition">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                                <i class="fa-solid fa-scale-balanced text-sm"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-700">Syarat & Ketentuan</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </a>

                    <!-- Item 2 -->
                    <a href="#" class="flex items-center justify-between p-3.5 hover:bg-slate-50 transition">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                                <i class="fa-solid fa-shield-halved text-sm"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-700">Kebijakan Privasi</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </a>

                    <!-- Item 3 -->
                    <a href="#" class="flex items-center justify-between p-3.5 hover:bg-slate-50 transition">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600">
                                <i class="fa-solid fa-book-open text-sm"></i>
                            </div>
                            <span class="text-xs font-semibold text-slate-700">Panduan Pengguna</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
                    </a>
                </div>
            </div>

            <!-- Kartu Pengembang -->
            <div class="bg-white p-3.5 rounded-xl shadow-sm border border-slate-100 flex items-center space-x-3 mb-6 relative overflow-hidden">
                <div class="w-9 h-9 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600 flex-shrink-0">
                    <i class="fa-solid fa-code text-sm"></i>
                </div>
                <div>
                    <p class="text-[10px] text-slate-400 font-medium">Dikembangkan oleh</p>
                    <p class="text-xs font-bold text-slate-800 leading-tight">SMK IT Team Development Division</p>
                </div>
            </div>
        </div>

        <!-- Footer Contact & Copyright -->
        <div class="pt-4 text-center">
            <!-- Icon Sosial/Kontak -->
            <div class="flex justify-center space-x-3 mb-4">
                <a href="#" class="w-9 h-9 rounded-full border border-slate-200 bg-white flex items-center justify-center text-slate-600 hover:text-emerald-600 transition shadow-sm">
                    <i class="fa-regular fa-envelope text-sm"></i>
                </a>
                <a href="#" class="w-9 h-9 rounded-full border border-slate-200 bg-white flex items-center justify-center text-slate-600 hover:text-emerald-600 transition shadow-sm">
                    <i class="fa-solid fa-phone text-sm"></i>
                </a>
                <a href="#" class="w-9 h-9 rounded-full border border-slate-200 bg-white flex items-center justify-center text-slate-600 hover:text-emerald-600 transition shadow-sm">
                    <i class="fa-solid fa-globe text-sm"></i>
                </a>
            </div>

            <!-- Copyright Text -->
            <p class="text-[10px] text-slate-500 font-medium">
                © 2024 Q-CIS SMK Mart. Hak Cipta Dilindungi.
            </p>
        </div>

    </div>

</body>
</html>