<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TokoOnline - Keren & Cepat</title>
    <!-- Kita pakai Tailwind CSS biar tampilannya langsung estetik -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased relative">

    <!-- NOTIFIKASI POP-UP (Awalnya tersembunyi) -->
    <div id="toast" class="fixed bottom-5 right-5 bg-emerald-600 text-white px-6 py-3 rounded-lg shadow-2xl transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center space-x-2">
        <span>✅</span>
        <span id="toast-message">Produk berhasil ditambah ke keranjang!</span>
    </div>

    <!-- 1. NAVBAR (Navigasi Atas) -->
    <nav class="bg-white shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-2xl font-black text-indigo-600 tracking-wider">ECOMMARC.</span>
                </div>
                <!-- Menu Kategori -->
                <div class="hidden md:flex space-x-8 font-medium">
                    <a href="#" class="text-indigo-600">Home</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">Produk</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">Promo</a>
                    <a href="#" class="text-gray-500 hover:text-gray-900">Kontak</a>
                </div>
                <!-- Keranjang & Profil -->
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-400 hover:text-gray-500 relative">
                        <!-- Angka di keranjang, kita kasih ID agar bisa diubah dengan JS -->
                        <span id="cart-counter" class="absolute top-1 right-1 bg-red-500 text-white text-xs w-4 h-4 rounded-full flex items-center justify-center font-bold">0</span>
                        🛒
                    </button>
                    <div class="w-8 h-8 rounded-full bg-indigo-200 flex items-center justify-center text-indigo-700 font-bold">
                        U
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. HERO SECTION (Banner Utama) -->
    <header class="bg-indigo-900 text-white py-20 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 tracking-tight">
                Belanja Puas, Harga Pas!
            </h1>
            <p class="text-indigo-200 text-lg md:text-xl max-w-2xl mx-auto mb-8">
                Dapatkan barang-barang impianmu dengan diskon hingga 50% khusus minggu ini. Jangan sampai kehabisan!
            </p>
            <!-- Tombol Mulai Belanja -->
            <button onclick="scrollToProducts()" class="bg-amber-400 hover:bg-amber-500 text-slate-900 font-bold px-8 py-3 rounded-full shadow-lg transition duration-300 transform hover:scale-105 active:scale-95">
                Mulai Belanja Sekarang
            </button>
        </div>
    </header>

    <!-- 3. DAFTAR PRODUK -->
    <main id="product-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 border-b pb-4">Produk Terpopuler</h2>
        
        <!-- Grid Produk -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            <!-- Kartu Produk 1 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400 group-hover:scale-105 transition duration-300">
                    <span class="text-4xl">👟</span>
                </div>
                <div class="p-4">
                    <span class="text-xs text-indigo-600 font-bold uppercase tracking-wider">Fashion</span>
                    <h3 class="font-semibold text-gray-800 mt-1 mb-2">Sepatu Sneakers Keren</h3>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg text-gray-900">Rp 450.000</span>
                        <!-- Tombol Tambah Keranjang dengan Event Onclick -->
                        <button onclick="addToCart('Sepatu Sneakers Keren')" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold px-3 py-1.5 rounded-lg text-sm transition transform active:scale-90">
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kartu Produk 2 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400 group-hover:scale-105 transition duration-300">
                    <span class="text-4xl">🎒</span>
                </div>
                <div class="p-4">
                    <span class="text-xs text-indigo-600 font-bold uppercase tracking-wider">Aksesoris</span>
                    <h3 class="font-semibold text-gray-800 mt-1 mb-2">Tas Ransel Anti Air</h3>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg text-gray-900">Rp 299.000</span>
                        <button onclick="addToCart('Tas Ransel Anti Air')" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold px-3 py-1.5 rounded-lg text-sm transition transform active:scale-90">
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kartu Produk 3 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400 group-hover:scale-105 transition duration-300">
                    <span class="text-4xl">⌚</span>
                </div>
                <div class="p-4">
                    <span class="text-xs text-indigo-600 font-bold uppercase tracking-wider">Jam Tangan</span>
                    <h3 class="font-semibold text-gray-800 mt-1 mb-2">Smartwatch Sport v5</h3>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg text-gray-900">Rp 899.000</span>
                        <button onclick="addToCart('Smartwatch Sport v5')" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold px-3 py-1.5 rounded-lg text-sm transition transform active:scale-90">
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Kartu Produk 4 -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400 group-hover:scale-105 transition duration-300">
                    <span class="text-4xl">🎧</span>
                </div>
                <div class="p-4">
                    <span class="text-xs text-indigo-600 font-bold uppercase tracking-wider">Elektronik</span>
                    <h3 class="font-semibold text-gray-800 mt-1 mb-2">Wireless Headphone Bass</h3>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg text-gray-900">Rp 550.000</span>
                        <button onclick="addToCart('Wireless Headphone Bass')" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold px-3 py-1.5 rounded-lg text-sm transition transform active:scale-90">
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- 4. FOOTER -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center border-t border-gray-800 mt-20">
        <p class="text-sm">&copy; 2026 ECOMMARC. All rights reserved. Bikinnya pake Laravel Blade!</p>
    </footer>

    <!-- JAVASCRIPT UNTUK AKSI TOMBOL -->
    <script>
        // Deklarasikan jumlah barang di keranjang mulai dari 0
        let cartCount = 0;

        function addToCart(productName) {
            // 1. Tambah jumlah keranjang
            cartCount++;
            document.getElementById('cart-counter').innerText = cartCount;

            // 2. Munculkan Notifikasi Pop-up (Toast)
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            
            toastMessage.innerText = `${productName} berhasil ditambah!`;
            
            // Efek animasi muncul
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            // Sembunyikan kembali notifikasi setelah 2 detik
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 2000);
        }

        // Fungsi scroll halus ketika klik "Mulai Belanja Sekarang"
        function scrollToProducts() {
            document.getElementById('product-section').scrollIntoView({ behavior: 'smooth' });
        }
    </script>

</body>
</html>