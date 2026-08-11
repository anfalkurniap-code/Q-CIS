<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan & FAQ - Q-CIS SMK</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk fitur Accordion -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Remixicon / FontAwesome untuk Ikon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen pb-12">

    <!-- Container Utama Tampilan Mobile / Responsive -->
    <div class="max-w-md mx-auto bg-slate-50 min-h-screen flex flex-col justify-between shadow-lg relative">

        <div>
            <!-- Header Navigasi -->
            <header class="bg-white px-4 py-3 flex items-center justify-between border-b border-gray-100 sticky top-0 z-50">
                <div class="flex items-center space-x-2">
                    <div class="bg-emerald-600 text-white p-2 rounded-lg flex items-center justify-center">
                        <i class="ri-shopping-bag-3-fill text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-emerald-800 text-sm leading-tight tracking-tight">Q-CIS SMK</h1>
                        <p class="text-[9px] text-gray-500 font-medium uppercase tracking-wider">Mart Management</p>
                    </div>
                </div>
                <button class="text-gray-700 p-1">
                    <i class="ri-menu-line text-xl"></i>
                </button>
            </header>

            <!-- Main Content Area -->
            <main class="p-4 space-y-4">

                <!-- Tombol Kembali & Breadcrumb -->
                <div class="flex items-center justify-between">
                    <a href="{{ url('/HalamanProfile') }}" class="inline-flex items-center space-x-1.5 bg-emerald-100/70 text-emerald-700 text-xs font-medium px-3 py-1.5 rounded-full hover:bg-emerald-200 transition">
                        <i class="ri-arrow-left-line"></i>
                        <span>Kembali</span>
                    </a>
                    <div class="text-[11px] text-gray-400 font-medium">
                        Profile &gt; <span class="text-emerald-600 font-semibold">Bantuan</span>
                    </div>
                </div>

                <!-- Hero Section / Title -->
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Pusat Bantuan & FAQ</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Cari solusi cepat untuk kendala transaksi Anda.</p>
                </div>

                <!-- Search Card & Populer Tag -->
                <div class="bg-white rounded-xl p-3 shadow-sm border border-gray-100 space-y-3">
                    <div class="relative">
                        <i class="ri-search-line absolute left-3 top-1/2 -translate-y-1/2 text-emerald-600 text-base"></i>
                        <input type="text" placeholder="Ketik kata kunci (QRIS, PIN, Topup)..." class="w-full bg-slate-50 border border-gray-200 text-xs rounded-lg pl-9 pr-3 py-2.5 focus:outline-none focus:ring-1 focus:ring-emerald-500 placeholder-gray-400">
                    </div>
                    
                    <div class="flex items-center space-x-2 text-[10px]">
                        <span class="text-gray-400">Populer:</span>
                        <div class="flex space-x-1.5 overflow-x-auto no-scrollbar">
                            <button class="bg-slate-100 hover:bg-slate-200 text-gray-600 px-2.5 py-1 rounded-md font-medium whitespace-nowrap">Masalah Login</button>
                            <button class="bg-slate-100 hover:bg-slate-200 text-gray-600 px-2.5 py-1 rounded-md font-medium whitespace-nowrap">Reset PIN</button>
                            <button class="bg-slate-100 hover:bg-slate-200 text-gray-600 px-2.5 py-1 rounded-md font-medium whitespace-nowrap">Scan QR</button>
                        </div>
                    </div>
                </div>

                <!-- Pertanyaan Umum (Accordion dengan AlpineJS) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ openFaq: null }">
                    <div class="p-3.5 flex items-center justify-between border-b border-gray-100 bg-white">
                        <h3 class="font-bold text-gray-800 text-sm">Pertanyaan Umum</h3>
                        <div class="text-emerald-600 bg-emerald-50 p-1 rounded-md">
                            <i class="ri-questionnaire-line text-sm"></i>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-100">
                        <!-- FAQ 1 -->
                        <div class="text-xs">
                            <button @click="openFaq = (openFaq === 1 ? null : 1)" class="w-full text-left p-3.5 font-semibold text-gray-800 flex justify-between items-center hover:bg-slate-50 transition">
                                <span class="pr-2">Bagaimana cara melakukan pembayaran QRIS?</span>
                                <i class="ri-arrow-down-s-line text-base text-gray-400 transition-transform duration-200" :class="{'rotate-180': openFaq === 1}"></i>
                            </button>
                            <div x-show="openFaq === 1" x-collapse class="px-3.5 pb-3.5 text-gray-500 text-[11px] leading-relaxed">
                                Anda dapat melakukan pembayaran QRIS dengan menekan tombol Scan QR di halaman utama, lalu arahkan kamera ke kode QRIS merchant.
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="text-xs">
                            <button @click="openFaq = (openFaq === 2 ? null : 2)" class="w-full text-left p-3.5 font-semibold text-gray-800 flex justify-between items-center hover:bg-slate-50 transition">
                                <span class="pr-2">Apa yang harus dilakukan jika transaksi gagal?</span>
                                <i class="ri-arrow-down-s-line text-base text-gray-400 transition-transform duration-200" :class="{'rotate-180': openFaq === 2}"></i>
                            </button>
                            <div x-show="openFaq === 2" x-collapse class="px-3.5 pb-3.5 text-gray-500 text-[11px] leading-relaxed">
                                Pastikan koneksi internet Anda stabil dan saldo mencukupi. Jika saldo terpotong namun transaksi gagal, hubungi support kami.
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="text-xs">
                            <button @click="openFaq = (openFaq === 3 ? null : 3)" class="w-full text-left p-3.5 font-semibold text-gray-800 flex justify-between items-center hover:bg-slate-50 transition">
                                <span class="pr-2">Bagaimana cara mengganti PIN transaksi?</span>
                                <i class="ri-arrow-down-s-line text-base text-gray-400 transition-transform duration-200" :class="{'rotate-180': openFaq === 3}"></i>
                            </button>
                            <div x-show="openFaq === 3" x-collapse class="px-3.5 pb-3.5 text-gray-500 text-[11px] leading-relaxed">
                                Masuk ke menu Profile > Pengaturan Keamanan > Ubah PIN Transaksi. Masukkan PIN lama lalu buat PIN baru Anda.
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="text-xs">
                            <button @click="openFaq = (openFaq === 4 ? null : 4)" class="w-full text-left p-3.5 font-semibold text-gray-800 flex justify-between items-center hover:bg-slate-50 transition">
                                <span class="pr-2">Di mana saya bisa melihat riwayat transaksi?</span>
                                <i class="ri-arrow-down-s-line text-base text-gray-400 transition-transform duration-200" :class="{'rotate-180': openFaq === 4}"></i>
                            </button>
                            <div x-show="openFaq === 4" x-collapse class="px-3.5 pb-3.5 text-gray-500 text-[11px] leading-relaxed">
                                Riwayat transaksi dapat diakses pada tab 'Riwayat' di bagian bawah aplikasi atau melalui dasbor akun Anda.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak Bantuan -->
                <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 space-y-3 relative overflow-hidden">
                    <!-- Hiasan background lengkungan halus kanan atas -->
                    <div class="absolute -top-6 -right-6 w-16 h-16 bg-emerald-50 rounded-full pointer-events-none"></div>

                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Kontak Bantuan</h3>
                        <p class="text-[11px] text-gray-500 mt-0.5">Tim support kami siap melayani pada hari sekolah.</p>
                    </div>

                    <div class="space-y-2">
                        <!-- WhatsApp Support -->
                        <a href="https://wa.me/628123456789" target="_blank" class="flex items-center justify-between p-2.5 rounded-xl border border-gray-100 hover:border-emerald-200 hover:bg-slate-50 transition">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100/80 text-emerald-600 flex items-center justify-center">
                                    <i class="ri-chat-3-fill text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-800">WhatsApp Support</p>
                                    <p class="text-[10px] text-gray-400">Respon cepat via chat</p>
                                </div>
                            </div>
                            <i class="ri-arrow-right-s-line text-gray-400 text-base"></i>
                        </a>

                        <!-- Email Support -->
                        <a href="mailto:support@qcismart.sch.id" class="flex items-center justify-between p-2.5 rounded-xl border border-gray-100 hover:border-emerald-200 hover:bg-slate-50 transition">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-100/80 text-emerald-600 flex items-center justify-center">
                                    <i class="ri-mail-fill text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-800">Email Support</p>
                                    <p class="text-[10px] text-gray-400">support@qcismart.sch.id</p>
                                </div>
                            </div>
                            <i class="ri-arrow-right-s-line text-gray-400 text-base"></i>
                        </a>
                    </div>
                </div>

                <!-- Jam Operasional Banner -->
                <div class="bg-emerald-600 rounded-2xl p-4 text-white relative overflow-hidden shadow-md">
                    <div class="flex justify-between items-start">
                        <div class="space-y-1 z-10">
                            <p class="text-[9px] uppercase font-semibold tracking-wider text-emerald-200">Jam Operasional</p>
                            <h4 class="text-base font-bold">Senin - Jumat</h4>
                            <p class="text-xs text-emerald-100 font-medium">07:30 - 15:45 WIB</p>
                        </div>
                        <div class="text-emerald-300 text-3xl opacity-80">
                            <i class="ri-time-line"></i>
                        </div>
                    </div>

                    <div class="mt-4 pt-2 border-t border-emerald-500/50 flex items-center space-x-1.5 text-[10px] text-emerald-100">
                        <i class="ri-information-line"></i>
                        <span>Tutup pada hari libur nasional</span>
                    </div>
                </div>

                <!-- Banner Panduan Pengguna Image -->
                <div class="relative rounded-2xl overflow-hidden shadow-sm h-32 bg-slate-800 group cursor-pointer">
                    <!-- Image Background -->
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=600&q=80" alt="Panduan Pengguna" class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition duration-300">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-3">
                        <span class="bg-emerald-600 text-white text-[10px] font-semibold px-2.5 py-1 rounded-md shadow">
                            Panduan Pengguna v2.0
                        </span>
                    </div>
                </div>

            </main>

            <!-- Footer -->
            <footer class="text-center py-6 px-4 space-y-2 border-t border-gray-100 mt-4">
                <p class="text-[10px] text-gray-400">© 2024 Q-CIS SMK Mart Management System</p>
                <div class="flex justify-center space-x-3 text-[10px]">
                    <a href="#" class="text-emerald-600 font-medium underline">Syarat & Ketentuan</a>
                    <a href="#" class="text-emerald-600 font-medium underline">Kebijakan Privasi</a>
                </div>
            </footer>
        </div>

        <!-- Floating Action Button (Kanan Bawah) -->
        <div class="fixed bottom-4 right-4 z-50 max-w-md mx-auto">
            <button class="w-12 h-12 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full flex items-center justify-center shadow-lg transition transform active:scale-95">
                <i class="ri-shopping-bag-line text-xl"></i>
            </button>
        </div>

    </div>

</body>
</html>