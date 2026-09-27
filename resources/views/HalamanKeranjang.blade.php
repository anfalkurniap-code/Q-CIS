<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS - Keranjang Belanja</title>   
    <script src="https://cdn.tailwindcss.com"></script>   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        #cart-list::-webkit-scrollbar {
            width: 5px;
        }
        #cart-list::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        #cart-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        #cart-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center p-0 md:p-4 font-sans">

    <div class="w-full max-w-md bg-white h-screen md:h-[820px] md:max-h-[92vh] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-between overflow-hidden">
        
        <!-- ================= TOP HEADER BAR ================= -->
        <div class="px-5 pt-5 pb-3 bg-white shrink-0 border-b border-gray-100 z-10">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <a href="{{ url('/HalamanShop') }}" class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition active:scale-95" title="Kembali">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                    </a>
                    <div>
                        <h1 class="text-lg font-bold text-slate-800 leading-tight">Keranjang Belanja</h1>
                        <p class="text-[11px] text-slate-400">Periksa daftar item belanja Anda</p>
                    </div>
                </div>

                <span id="cart-badge-count" class="text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-100">
                    0 Item
                </span>
            </div>
        </div>

        <!-- ================= DAFTAR ITEM KERANJANG (SCROLLABLE) ================= -->
        <div id="cart-list" class="px-5 py-4 space-y-3 flex-1 overflow-y-auto">
            <!-- Konten keranjang dirender via JavaScript -->
        </div>

        <!-- ================= RINGKASAN & TOMBOL BAYAR (BOTTOM) ================= -->
        <div class="bg-slate-50/90 border-t border-slate-100 px-5 pt-4 pb-5 shrink-0 rounded-b-3xl">
            <div class="space-y-2 pb-3 text-xs">
                <div class="flex justify-between text-slate-500 font-medium">
                    <span>Subtotal</span>
                    <span id="subtotal" class="font-bold text-slate-800 text-sm">Rp 0</span>
                </div>
            </div>

            <div class="pt-3 border-t border-slate-200/70 flex justify-between items-center mb-4">
                <div>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total Tagihan</p>
                    <span id="total-tagihan" class="text-xl font-extrabold text-emerald-800">Rp 0</span>
                </div>
            </div>

            <a id="btn-checkout" href="{{ url('/halamanpembayaran') }}" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-emerald-800/20 flex items-center justify-center space-x-2 transition-all active:scale-[0.98]">
                <span>Bayar Sekarang</span>
                <i class="fa-solid fa-arrow-right text-sm"></i>
            </a>
        </div>

    </div>

    <script>
    let cart = JSON.parse(localStorage.getItem('cartItems')) || [];

    function formatRupiah(number) {
        return 'Rp ' + Number(number || 0).toLocaleString('id-ID');
    }

    function renderCart() {
        const container = document.getElementById('cart-list');
        const badgeCount = document.getElementById('cart-badge-count');
        const btnCheckout = document.getElementById('btn-checkout');
        let subtotal = 0;
        let totalItems = 0;

        if (!container || cart.length === 0) {
            if (container) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full py-16 text-center text-gray-400">
                        <div class="w-20 h-20 rounded-full bg-emerald-50 flex items-center justify-center mb-4 text-emerald-600">
                            <i class="fa-solid fa-basket-shopping text-3xl"></i>
                        </div>
                        <p class="font-bold text-slate-700 text-base">Keranjang Kosong</p>
                        <p class="text-xs text-slate-400 mt-1 mb-6 max-w-[220px]">Belum ada produk yang ditambahkan ke keranjang belanja</p>
                        <a href="{{ url('/HalamanShop') }}" class="px-5 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white rounded-xl text-xs font-bold transition shadow-sm">
                            Mulai Belanja Sekarang
                        </a>
                    </div>
                `;
            }
            if (badgeCount) badgeCount.innerText = '0 Item';
            if (btnCheckout) {
                btnCheckout.classList.add('opacity-50', 'pointer-events-none');
            }
            updateSummary(0);
            return;
        }

        if (btnCheckout) {
            btnCheckout.classList.remove('opacity-50', 'pointer-events-none');
        }

        let html = '';
        cart.forEach((item, index) => {
            let itemTotal = item.harga * item.qty;
            subtotal += itemTotal;
            totalItems += item.qty;

            html += `
                <div class="flex items-center justify-between p-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-emerald-100 transition">
                    <div class="flex items-center gap-3 min-w-0">
                        <img src="${item.img || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=200'}" 
                             alt="${item.nama}" 
                             class="w-14 h-14 object-cover rounded-xl border border-gray-100 shrink-0 bg-gray-50"
                             onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=200'">
                        <div class="min-w-0">
                            <h4 class="font-bold text-sm text-slate-800 leading-tight truncate">${item.nama}</h4>
                            <p class="text-xs text-emerald-700 font-bold mt-1">${formatRupiah(item.harga)}</p>
                            ${item.stok !== undefined ? `<p class="text-[10px] text-gray-400 mt-0.5">Maks. stok: <span class="font-semibold text-slate-600">${item.stok}</span></p>` : ''}
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0 ml-2">
                        <div class="flex items-center bg-gray-50 border border-gray-200/80 rounded-xl p-1 gap-1">
                            <button onclick="ubahQty(${index}, -1)" class="w-6 h-6 rounded-lg bg-white text-slate-700 hover:text-emerald-700 flex items-center justify-center text-xs font-bold shadow-sm transition active:scale-95" title="Kurangi">
                                <i class="fa-solid fa-minus text-[10px]"></i>
                            </button>
                            <span class="text-xs font-bold text-slate-800 w-5 text-center">${item.qty}</span>
                            <button onclick="ubahQty(${index}, 1)" class="w-6 h-6 rounded-lg bg-emerald-700 text-white flex items-center justify-center text-xs font-bold shadow-sm hover:bg-emerald-800 transition active:scale-95" title="Tambah">
                                <i class="fa-solid fa-plus text-[10px]"></i>
                            </button>
                        </div>
                        <button onclick="hapusItem(${index})" class="w-8 h-8 rounded-xl bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center text-xs transition active:scale-95" title="Hapus">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;
        if (badgeCount) badgeCount.innerText = totalItems + ' Item';
        updateSummary(subtotal);
    }

    function updateSummary(subtotal) {
        if (document.getElementById('subtotal')) {
            document.getElementById('subtotal').innerText = formatRupiah(subtotal);
        }
        if (document.getElementById('total-tagihan')) {
            document.getElementById('total-tagihan').innerText = formatRupiah(subtotal);
        }
    }

    function ubahQty(index, delta) {
        let item = cart[index];

        if (delta > 0) {
            if (item.stok !== undefined && item.qty >= Number(item.stok)) {
                alert(`Maaf, stok ${item.nama} hanya tersisa ${item.stok} item!`);
                return;
            }
        }

        item.qty += delta;

        if (item.qty <= 0) {
            cart.splice(index, 1);
        }

        localStorage.setItem('cartItems', JSON.stringify(cart));
        renderCart();
    }

    function hapusItem(index) {
        cart.splice(index, 1);
        localStorage.setItem('cartItems', JSON.stringify(cart));
        renderCart();
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) {
            lucide.createIcons();
        }
        renderCart();
    });
    window.addEventListener('pageshow', renderCart);
    window.addEventListener('focus', renderCart);
    </script>
</body>
</html>