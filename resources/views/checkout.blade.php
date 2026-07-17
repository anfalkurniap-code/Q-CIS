<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK - Keranjang Belanja</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Icon Presisi -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js untuk Interaktivitas Instan -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-100 flex justify-center items-center min-h-screen p-4">

    <!-- Container Frame HP Mockup -->
    <div class="w-full max-w-md bg-white min-h-[720px] flex flex-col justify-between relative shadow-2xl overflow-hidden rounded-3xl border border-gray-100"
         x-data="checkoutApp()">
        
        <div>
            <!-- Handlebar Atas Bottom Sheet Mockup -->
            <div class="w-full flex justify-center pt-3 pb-1">
                <div class="w-12 h-1 bg-slate-300 rounded-full"></div>
            </div>

            <!-- HEADER -->
            <div class="flex justify-between items-center px-6 py-4">
                <h1 class="text-xl font-bold text-slate-800 tracking-tight">Keranjang Belanja</h1>
                <!-- Tombol Close (X) otomatis mengarah ke route 'katalog' -->
                <a href="{{ route('katalog') }}" class="w-8 h-8 rounded-full hover:bg-slate-100 flex items-center justify-center transition" title="Kembali ke Katalog">
                    <i class="fa-solid fa-xmark text-slate-600 text-lg"></i>
                </a>
            </div>

            <!-- DAFTAR ITEM DI KERANJANG -->
            <div class="px-6 space-y-4 overflow-y-auto max-h-[380px] pb-4">
                <template x-for="item in cartItems" :key="item.id">
                    <div class="flex items-center justify-between border-b border-slate-50 pb-4">
                        <div class="flex items-center gap-3">
                            <!-- Placeholder nama produk -->
                            <div :class="item.bgClass || 'bg-emerald-600'" class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xs shadow-inner shrink-0">
                                <span x-text="item.name.substring(0, 2).toUpperCase()"></span>
                            </div>
                            
                            <div>
                                <h3 class="font-bold text-slate-800 text-sm" x-text="item.name"></h3>
                                <p class="text-xs text-gray-400 mt-0.5" x-text="formatRupiah(item.price)"></p>
                                
                                <!-- Pengatur Kuantitas (- Qty +) -->
                                <div class="flex items-center gap-2 mt-2">
                                    <button @click="updateQty(item.id, -1)" class="w-6 h-6 rounded-full border border-emerald-600 text-emerald-600 flex items-center justify-center hover:bg-emerald-50 transition font-semibold text-xs">-</button>
                                    <span class="text-xs font-bold text-slate-800 w-4 text-center" x-text="item.qty"></span>
                                    <button @click="updateQty(item.id, 1)" class="w-6 h-6 rounded-full bg-emerald-800 text-white flex items-center justify-center hover:bg-emerald-700 transition font-semibold text-xs">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Harga Total Item & Tombol Hapus -->
                        <div class="text-right flex flex-col items-end gap-2">
                            <span class="text-sm font-bold text-emerald-800" x-text="formatRupiah(item.price * item.qty)"></span>
                            <button @click="removeItem(item.id)" class="text-red-500 hover:text-red-700 p-1.5 rounded-lg hover:bg-red-50 transition">
                                <i class="fa-regular fa-trash-can text-sm"></i>
                            </button>
                        </div>
                    </div>
                </template>

                <!-- Keadaan Keranjang Kosong -->
                <div x-show="cartItems.length === 0" class="text-center py-16 text-slate-400">
                    <i class="fa-solid fa-basket-shopping text-4xl mb-3 block text-slate-300"></i>
                    Keranjang belanjaanmu kosong.
                </div>
            </div>
        </div>

        <!-- AREA RINCIAN TAGIHAN & BAYAR (BOTTOM PANEL) -->
        <div class="bg-slate-50 border-t border-slate-100 rounded-t-[2.5rem] p-6 shadow-[0_-8px_20px_rgba(0,0,0,0.02)] space-y-5">
            <!-- Box Ringkasan Biaya -->
            <div class="space-y-3">
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-500 font-medium">Subtotal</span>
                    <span class="font-bold text-slate-800" x-text="formatRupiah(getSubtotal())"></span>
                </div>
                
                <div class="flex justify-between items-center text-sm">
                    <span class="text-slate-500 font-medium">Diskon Pelajar</span>
                    <span class="font-bold text-emerald-600" x-text="'- ' + formatRupiah(discount)"></span>
                </div>

                <div class="border-t border-dashed border-slate-200 my-2"></div>

                <div class="flex justify-between items-center">
                    <span class="text-base font-bold text-slate-800">Total Tagihan</span>
                    <span class="text-xl font-black text-emerald-800" x-text="formatRupiah(getTotalPay())"></span>
                </div>
            </div>

            <!-- Tombol Bayar Sekarang -->
            <button @click="payNow()" 
                    :disabled="cartItems.length === 0"
                    :class="cartItems.length === 0 ? 'bg-gray-300 cursor-not-allowed shadow-none' : 'bg-emerald-800 hover:bg-emerald-900 active:scale-[0.98] shadow-md shadow-emerald-800/10'"
                    class="w-full text-white py-4 rounded-2xl font-bold text-base flex items-center justify-center gap-2 transition duration-200">
                <span>Bayar Sekarang</span>
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </button>
        </div>

    </div>

    <script>
        function checkoutApp() {
            return {
                cartItems: [],
                discount: 0,

                // Fungsi otomatis berjalan saat halaman dimuat
                init() {
                    const savedCart = localStorage.getItem('qcis_cart');
                    if (savedCart) {
                        this.cartItems = JSON.parse(savedCart);
                    }
                    // Berikan diskon pelajar Rp 8.000 jika ada item di keranjang
                    this.discount = this.cartItems.length > 0 ? 8000 : 0;
                },

                getSubtotal() {
                    return this.cartItems.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },

                getTotalPay() {
                    let total = this.getSubtotal() - this.discount;
                    return total > 0 ? total : 0;
                },

                updateQty(id, amount) {
                    let item = this.cartItems.find(item => item.id === id);
                    if (item) {
                        item.qty += amount;
                        if (item.qty <= 0) {
                            this.removeItem(id);
                        }
                    }
                    localStorage.setItem('qcis_cart', JSON.stringify(this.cartItems));
                },

                removeItem(id) {
                    this.cartItems = this.cartItems.filter(item => item.id !== id);
                    if (this.cartItems.length === 0) {
                        this.discount = 0;
                    }
                    localStorage.setItem('qcis_cart', JSON.stringify(this.cartItems));
                },

                formatRupiah(number) {
                    return 'Rp ' + number.toLocaleString('id-ID');
                },

                payNow() {
                    alert('Pembayaran sebesar ' + this.formatRupiah(this.getTotalPay()) + ' Berhasil!\nSilakan ambil struk belanja Anda di kasir Q-CIS SMK.');
                    
                    // Bersihkan keranjang setelah bayar
                    this.cartItems = [];
                    this.discount = 0;
                    localStorage.removeItem('qcis_cart');
                    
                    window.location.href = "{{ route('katalog') }}";
                }
            }
        }
    </script>
</body>
</html>