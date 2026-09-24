<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan & FAQ - Q-CIS SMK</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js Collapse Plugin (Wajib ada untuk x-collapse) -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine.js Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Remixicon untuk Ikon -->
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

                <!-- Pertanyaan Umum (Accordion dengan AlpineJS) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ openFaq: 1 }">
                    <div class="p-3.5 flex items-center justify-between border-b border-gray-100 bg-white">
                        <h3 class="font-bold text-gray-800 text-sm">Pertanyaan Umum</h3>
                        <div class="text-emerald-600 bg-emerald-50 p-1.5 rounded-lg flex items-center justify-center">
                            <i class="ri-questionnaire-line text-base"></i>
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
                                Masuk ke menu Profile &gt; Pengaturan Keamanan &gt; Ubah PIN Transaksi. Masukkan PIN lama lalu buat PIN baru Anda.
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

            </main>

            <!-- Footer -->
            <footer class="text-center py-6 px-4 space-y-2 border-t border-gray-100 mt-4">
                <p class="text-[10px] text-gray-400">© 2024 Q-CIS SMK Mart Management System</p>
            </footer>
        </div>

    </div>

</body>
</html>