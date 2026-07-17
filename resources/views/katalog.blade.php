<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK - Katalog</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Icon Presisi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js untuk Interaktivitas Instan -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Custom scrollbar halus untuk kategori */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <!-- Container Frame HP agar semirip mungkin dengan referensi gambar -->
    <div class="w-full max-w-md bg-white min-h-screen flex flex-col relative shadow-2xl overflow-hidden rounded-3xl border border-gray-200"
         x-data="martApp()">
        
        <!-- HEADER -->
        <header class="px-5 pt-6 pb-4 bg-white sticky top-0 z-10 border-b border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold text-emerald-800 tracking-tight">Q-CIS SMK</h1>
                <div class="flex items-center gap-4">
                    <button class="relative text-gray-600 hover:text-emerald-700">
                        <i class="fa-regular fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <!-- Avatar User -->
                    <div class="w-8 h-8 rounded-full bg-emerald-100 border border-emerald-200 flex items-center justify-center text-xs font-semibold text-emerald-800">
                        T
                    </div>
                </div>
            </div>

            <!-- Bar Pencarian (Berfungsi Menyaring Produk) -->
            <div class="relative mb-4">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </span>
                <input type="text" 
                       x-model="searchQuery" 
                       class="w-full pl-10 pr-4 py-2.5 bg-sky-50/50 border border-transparent focus:border-emerald-500 focus:bg-white rounded-xl text-sm outline-none transition" 
                       placeholder="Cari produk di mart...">
            </div>

            <!-- Tab Kategori (Berfungsi Menyaring Produk) -->
            <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1">
                <template x-for="cat in categories" :key="cat">
                    <button @click="selectedCategory = cat"
                            :class="selectedCategory === cat ? 'bg-emerald-800 text-white' : 'bg-sky-50 text-sky-800 hover:bg-sky-100'"
                            class="px-4 py-1.5 rounded-full text-xs font-semibold transition shrink-0"
                            x-text="cat">
                    </button>
                </template>
            </div>
        </header>

        <!-- KONTEN KATALOG PRODUK -->
        <main class="flex-1 px-5 py-4 pb-40 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-slate-800">Katalog Produk</h2>
                <span class="text-xs text-emerald-700 font-semibold" x-text="filteredProducts().length + ' Produk'"></span>
            </div>

            <!-- Grid Produk (2 Kolom) -->
            <div class="grid grid-cols-2 gap-4">
                <template x-for="product in filteredProducts()" :key="product.id">
                    <div class="bg-white border border-gray-100 rounded-2xl p-4 flex flex-col justify-between shadow-sm relative hover:border-emerald-200 transition">
                        
                        <!-- Badge Ketersediaan -->
                        <span :class="product.stock > 5 ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600'"
                              class="absolute top-3 right-3 text-[10px] font-bold px-2 py-0.5 rounded-md"
                              x-text="product.stock > 5 ? 'TERSEDIA' : 'HAMPIR HABIS'">
                        </span>

                        <!-- Pengganti Gambar: Kotak Kosong Minimalis sesuai Request -->
                        <div class="w-full h-24 bg-slate-50 rounded-xl mb-3 flex items-center justify-center text-xs text-slate-400 font-medium border border-dashed border-slate-200">
                            Tanpa Gambar
                        </div>

                        <!-- Info Nama & Stok saja -->
                        <div class="mb-3">
                            <h3 class="font-bold text-slate-800 text-sm line-clamp-2 leading-tight" x-text="product.name"></h3>
                            <p class="text-[10px] text-gray-400 mt-1" x-text="'Stok: ' + product.stock"></p>
                        </div>

                        <!-- Harga & Tombol Tambah -->
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-sm font-extrabold text-emerald-700" x-text="formatRupiah(product.price)"></span>
                            
                            <!-- Tombol Berfungsi: Tambah / Kurang Qty -->
                            <div class="flex items-center">
                                <template x-if="isInCart(product.id)">
                                    <div class="flex items-center bg-emerald-50 rounded-lg border border-emerald-200 overflow-hidden">
                                        <button @click="updateQty(product.id, -1)" class="px-2 py-1 text-emerald-800 hover:bg-emerald-100 font-bold text-xs">-</button>
                                        <span class="px-1 text-xs font-bold text-emerald-800" x-text="getCartQty(product.id)"></span>
                                        <button @click="updateQty(product.id, 1)" class="px-2 py-1 text-emerald-800 hover:bg-emerald-100 font-bold text-xs">+</button>
                                    </div>
                                </template>
                                <template x-if="!isInCart(product.id)">
                                    <button @click="addToCart(product)" class="w-7 h-7 bg-emerald-800 text-white rounded-lg flex items-center justify-center hover:bg-emerald-700 transition">
                                        <i class="fa-solid fa-plus text-xs"></i>
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Jika pencarian tidak ditemukan -->
            <div x-show="filteredProducts().length === 0" class="text-center py-12 text-gray-400 text-sm">
                <i class="fa-regular fa-face-frown text-3xl mb-2 block"></i>
                Produk tidak ditemukan
            </div>
        </main>

        <!-- STICKY BOTTOM CARD (TOTAL & CHECKOUT) -->
        <div class="absolute bottom-16 left-0 right-0 bg-white border-t border-gray-100 px-5 py-3 shadow-[0_-4px_10px_rgba(0,0,0,0.03)] z-20">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="relative bg-slate-100 p-2.5 rounded-xl">
                        <i class="fa-solid fa-cart-shopping text-emerald-800 text-lg"></i>
                        <span class="absolute -top-1.5 -right-1.5 bg-emerald-600 text-white text-[10px] font-bold px-1.5 py-0.2 rounded-full" x-text="cartCount()">0</span>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">TOTAL</p>
                        <p class="text-base font-extrabold text-emerald-800" x-text="formatRupiah(getTotalPrice())">Rp 0</p>
                    </div>
                </div>
                <!-- Tombol Checkout -->
                <button @click="checkout()" 
                        :disabled="cart.length === 0"
                        :class="cart.length === 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-emerald-800 hover:bg-emerald-700'"
                        class="px-5 py-2.5 text-white rounded-xl font-bold text-sm flex items-center gap-2 transition">
                    <span>Checkout</span>
                    <i class="fa-solid fa-chevron-up text-xs"></i>
                </button>
            </div>
        </div>

        <!-- NAVIGASI BAWAH (BOTTOM NAV BAR) -->
        <nav class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-100 h-16 flex justify-around items-center px-4 z-20">
            <button class="flex flex-col items-center gap-0.5 text-gray-400 hover:text-emerald-800">
                <i class="fa-solid fa-house text-lg"></i>
                <span class="text-[10px] font-medium">Home</span>
            </button>
            <button class="flex flex-col items-center gap-0.5 text-emerald-500">
                <div class="bg-emerald-100 px-5 py-1.5 rounded-full flex flex-col items-center">
                    <i class="fa-solid fa-cart-shopping text-base"></i>
                    <span class="text-[9px] font-bold">Shop</span>
                </div>
            </button>
            <button @click="alert('Fitur Transaksi')" class="flex flex-col items-center gap-0.5 text-gray-400 hover:text-emerald-800">
                <i class="fa-regular fa-clipboard text-lg"></i>
                <span class="text-[10px] font-medium">Trans</span>
            </button>
            <button @click="alert('Fitur Profil')" class="flex flex-col items-center gap-0.5 text-gray-400 hover:text-emerald-800">
                <i class="fa-regular fa-user text-lg"></i>
                <span class="text-[10px] font-medium">Profile</span>
            </button>
        </nav>

    </div>
 
    <script>
        function martApp() {
            return {
                searchQuery: '',
                selectedCategory: 'Semua',
                categories: ['Semua', 'Minuman', 'Makanan Ringan', 'Alat Tulis'],
                products: [
                    { id: 1, name: 'Coca-Cola Kaleng', price: 6500, stock: 24, category: 'Minuman', bgClass: 'bg-red-600' },
                    { id: 2, name: 'Lays Classic 68g', price: 10500, stock: 15, category: 'Makanan Ringan', bgClass: 'bg-amber-500' },
                    { id: 3, name: 'Susu UHT 250ml', price: 6000, stock: 42, category: 'Minuman', bgClass: 'bg-blue-600' },
                    { id: 4, name: 'Pulpen Faster C600', price: 3500, stock: 5, category: 'Alat Tulis', bgClass: 'bg-gray-700' },
                    { id: 5, name: 'Fanta Orange Can', price: 6500, stock: 12, category: 'Minuman', bgClass: 'bg-orange-500' },
                    { id: 6, name: 'Chiki Balls Keju', price: 8000, stock: 2, category: 'Makanan Ringan', bgClass: 'bg-yellow-500' }
                ],
                cart: [],

                // Memuat keranjang yang tersimpan dari checkout jika user kembali
                init() {
                    const savedCart = localStorage.getItem('qcis_cart');
                    if (savedCart) {
                        this.cart = JSON.parse(savedCart);
                    }
                },

                filteredProducts() {
                    return this.products.filter(product => {
                        const matchSearch = product.name.toLowerCase().includes(this.searchQuery.toLowerCase());
                        const matchCategory = this.selectedCategory === 'Semua' || product.category === this.selectedCategory;
                        return matchSearch && matchCategory;
                    });
                },

                addToCart(product) {
                    let found = this.cart.find(item => item.id === product.id);
                    if (found) {
                        if (found.qty < product.stock) found.qty++;
                    } else {
                        this.cart.push({ ...product, qty: 1 });
                    }
                    localStorage.setItem('qcis_cart', JSON.stringify(this.cart));
                },

                isInCart(id) {
                    return this.cart.some(item => item.id === id);
                },

                getCartQty(id) {
                    let item = this.cart.find(item => item.id === id);
                    return item ? item.qty : 0;
                },

                updateQty(id, amount) {
                    let item = this.cart.find(item => item.id === id);
                    let product = this.products.find(p => p.id === id);
                    if (item) {
                        item.qty += amount;
                        if (item.qty > product.stock) {
                            item.qty = product.stock;
                            alert('Stok produk tidak mencukupi!');
                        }
                        if (item.qty <= 0) {
                            this.cart = this.cart.filter(i => i.id !== id);
                        }
                    }
                    localStorage.setItem('qcis_cart', JSON.stringify(this.cart));
                },

                cartCount() {
                    return this.cart.reduce((sum, item) => sum + item.qty, 0);
                },

                getTotalPrice() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },

                formatRupiah(number) {
                    return 'Rp ' + number.toLocaleString('id-ID');
                },

                checkout() {
                    localStorage.setItem('qcis_cart', JSON.stringify(this.cart));
                    window.location.href = "{{ route('checkout') }}";
                }
            } 
        } 
    </script>
</body>
</html>