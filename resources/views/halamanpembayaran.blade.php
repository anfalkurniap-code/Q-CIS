<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS - Pembayaran Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        #payment-scroll-area::-webkit-scrollbar {
            width: 5px;
        }
        #payment-scroll-area::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        #payment-scroll-area::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        #payment-scroll-area::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-center p-0 md:p-4 font-sans">

    <div class="w-full max-w-md bg-white h-screen md:h-[820px] md:max-h-[92vh] md:rounded-3xl shadow-xl border border-slate-200 relative flex flex-col justify-between overflow-hidden">
        
        <form id="paymentForm" action="{{ route('pembayaran.proses') }}" method="POST" class="h-full flex flex-col justify-between overflow-hidden">
            @csrf
            <!-- Input Hidden Data Transaksi untuk Controller -->
            <input type="hidden" name="cart_data" id="cartDataInput">
            <input type="hidden" name="payment_method" id="paymentMethodInput" value="cash">
            <input type="hidden" name="subtotal" id="subtotalInput" value="0">
            <input type="hidden" name="discount" id="discountInput" value="0">
            <input type="hidden" name="total_price" id="totalPriceInput" value="0">

            <!-- ================= TOP HEADER BAR ================= -->
            <div class="px-5 pt-5 pb-3 bg-white shrink-0 border-b border-gray-100 z-10">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/HalamanKeranjang') }}" class="w-9 h-9 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 transition active:scale-95" title="Kembali ke Keranjang">
                            <i class="fa-solid fa-arrow-left text-sm"></i>
                        </a>
                        <div>
                            <h1 class="text-lg font-bold text-slate-800 leading-tight">Pembayaran</h1>
                            <p class="text-[11px] text-slate-400">Konfirmasi transaksi kasir</p>
                        </div>
                    </div>

                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-100">
                        <i class="fa-solid fa-money-bill-wave text-[11px]"></i> Tunai
                    </span>
                </div>
            </div>

            <!-- ================= SCROLLABLE CONTENT ================= -->
            <div class="px-5 py-4 space-y-4 flex-1 overflow-y-auto" id="payment-scroll-area">

                <!-- Alert Error dari Server jika ada -->
                @if(session('error'))
                    <div class="p-3.5 bg-red-50 border border-red-200 rounded-2xl flex items-start gap-2.5 text-red-700 text-xs shadow-sm">
                        <i class="fa-solid fa-triangle-exclamation mt-0.5 text-sm text-red-500"></i>
                        <div>
                            <p class="font-bold">Transaksi Gagal</p>
                            <p class="mt-0.5 text-[11px] text-red-600">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Card 1: Rincian Pesanan -->
                <div class="bg-gray-50/70 border border-gray-100 rounded-2xl p-4">
                    <div class="flex items-center justify-between pb-2.5 border-b border-gray-200/60 mb-2">
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Rincian Pesanan</span>
                        <span class="text-xs font-bold text-emerald-800 bg-white px-2.5 py-0.5 rounded-full border border-gray-100 shadow-sm" id="totalItemsText">
                            0 Item
                        </span>
                    </div>

                    <div id="cartItemsContainer" class="space-y-2.5">
                        <!-- List Item dari LocalStorage -->
                    </div>
                </div>

                <!-- Card 2: Form Pembayaran Tunai -->
                <div class="bg-white border border-gray-100 rounded-2xl p-4 shadow-sm space-y-3">
                    <div class="flex items-center gap-2 pb-1 border-b border-gray-100">
                        <div class="w-6 h-6 rounded-lg bg-emerald-100/70 text-emerald-700 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-cash-register"></i>
                        </div>
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wide">Nominal Uang Diterima</h3>
                    </div>

                    <div>
                        <label for="cashAmount" class="block text-xs font-semibold text-slate-600 mb-1.5">Jumlah Uang Diterima (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" 
                                   id="cashAmount" 
                                   name="cash_amount" 
                                   placeholder="0" 
                                   oninput="calculateChange()" 
                                   value="{{ old('cash_amount') }}"
                                   class="w-full bg-slate-50 border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm font-bold text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-600/20 focus:border-emerald-600 focus:bg-white transition">
                        </div>
                    </div>

                    <!-- Shortcut Tombol Nominal Cepat -->
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <button type="button" onclick="setUangPas()" class="px-2.5 py-1 text-[11px] font-bold rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 transition active:scale-95">
                            Uang Pas
                        </button>
                        <button type="button" onclick="setCash(10000)" class="px-2.5 py-1 text-[11px] font-medium rounded-lg bg-gray-50 text-slate-600 hover:bg-gray-100 border border-gray-200 transition active:scale-95">
                            10.000
                        </button>
                        <button type="button" onclick="setCash(20000)" class="px-2.5 py-1 text-[11px] font-medium rounded-lg bg-gray-50 text-slate-600 hover:bg-gray-100 border border-gray-200 transition active:scale-95">
                            20.000
                        </button>
                        <button type="button" onclick="setCash(50000)" class="px-2.5 py-1 text-[11px] font-medium rounded-lg bg-gray-50 text-slate-600 hover:bg-gray-100 border border-gray-200 transition active:scale-95">
                            50.000
                        </button>
                        <button type="button" onclick="setCash(100000)" class="px-2.5 py-1 text-[11px] font-medium rounded-lg bg-gray-50 text-slate-600 hover:bg-gray-100 border border-gray-200 transition active:scale-95">
                            100.000
                        </button>
                    </div>

                    <!-- Kotak Kembalian Realtime -->
                    <div id="changeBox" class="p-3 rounded-xl border border-dashed border-gray-200 bg-slate-50 flex items-center justify-between transition-colors">
                        <span class="text-xs font-semibold text-slate-500" id="changeLabel">Uang Kembalian:</span>
                        <strong class="text-sm font-extrabold text-slate-800" id="changeText">Rp 0</strong>
                    </div>
                </div>

            </div>

            <!-- ================= BOTTOM RINGKASAN & TOMBOL SUBMIT ================= -->
            <div class="bg-slate-50/90 border-t border-slate-100 px-5 pt-4 pb-5 shrink-0 rounded-b-3xl">
                <div class="space-y-2 pb-3 text-xs">
                    <div class="flex justify-between text-slate-500 font-medium">
                        <span>Subtotal</span>
                        <span id="subtotalText" class="font-bold text-slate-800 text-sm">Rp 0</span>
                    </div>
                </div>

                <div class="pt-2.5 border-t border-slate-200/70 flex justify-between items-center mb-4">
                    <div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Total Tagihan</p>
                        <span id="totalText" class="text-xl font-extrabold text-emerald-800">Rp 0</span>
                    </div>
                </div>

                <button type="button" 
                        class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-emerald-800/20 flex items-center justify-center space-x-2 transition-all active:scale-[0.98] cursor-pointer" 
                        id="btnSubmit" 
                        onclick="processPayment()">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span>Selesaikan Pembayaran</span>
                </button>
            </div>

        </form>

    </div>

    <script>
        let totalPrice = 0;
        let cart = [];

        function formatRupiah(number) {
            return 'Rp ' + Number(number || 0).toLocaleString('id-ID');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const storedCart = localStorage.getItem('cartItems');
            if (storedCart) {
                try {
                    cart = JSON.parse(storedCart);
                } catch (e) {
                    cart = [];
                }
            }
            renderCart();
        });

        function renderCart() {
            const container = document.getElementById('cartItemsContainer');
            container.innerHTML = '';
            let subtotal = 0;
            let totalCount = 0;

            if (!cart || cart.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-6 text-gray-400">
                        <i class="fa-solid fa-basket-shopping text-2xl mb-1 text-slate-300"></i>
                        <p class="text-xs font-semibold text-slate-500">Keranjang belanja kosong</p>
                        <a href="{{ url('/HalamanShop') }}" class="text-[11px] text-emerald-700 font-bold underline mt-1 inline-block">Kembali ke Katalog</a>
                    </div>
                `;
            } else {
                cart.forEach((item, index) => {
                    const itemId = item.id || null;
                    const itemNama = item.nama || item.name || 'Produk';
                    const itemHarga = parseFloat(item.harga || item.price || 0);
                    const itemQty = parseInt(item.qty || item.jumlah || item.quantity || 1);
                    const itemImg = item.img || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=200';

                    const itemTotal = itemHarga * itemQty;
                    subtotal += itemTotal;
                    totalCount += itemQty;

                    cart[index] = {
                        id: itemId,
                        nama: itemNama,
                        harga: itemHarga,
                        qty: itemQty,
                        img: itemImg
                    };

                    const itemHTML = `
                        <div class="flex items-center justify-between p-2.5 bg-white border border-gray-100 rounded-xl shadow-xs">
                            <div class="flex items-center gap-2.5 min-w-0">
                                <img src="${itemImg}" 
                                     alt="${itemNama}" 
                                     class="w-10 h-10 object-cover rounded-lg border border-gray-100 shrink-0 bg-gray-50"
                                     onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=200'">
                                <div class="min-w-0">
                                    <h4 class="text-xs font-bold text-slate-800 leading-tight truncate">${itemNama}</h4>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Qty: <span class="font-bold text-slate-700">${itemQty}</span></p>
                                </div>
                            </div>
                            <div class="text-xs font-bold text-emerald-800 shrink-0 ml-2">
                                ${formatRupiah(itemTotal)}
                            </div>
                        </div>
                    `;
                    container.innerHTML += itemHTML;
                });
            }

            totalPrice = subtotal;

            // Update UI Text
            document.getElementById('totalItemsText').innerText = `${totalCount} Item`;
            document.getElementById('subtotalText').innerText = formatRupiah(subtotal);
            document.getElementById('totalText').innerText = formatRupiah(totalPrice);
            
            // Update input hidden untuk dikirim ke Laravel Controller
            document.getElementById('subtotalInput').value = subtotal;
            document.getElementById('discountInput').value = 0;
            document.getElementById('totalPriceInput').value = totalPrice;
            document.getElementById('cartDataInput').value = JSON.stringify(cart);

            calculateChange();
        }

        function calculateChange() {
            const cashRaw = document.getElementById('cashAmount').value;
            const cash = parseFloat(cashRaw) || 0;
            const change = cash - totalPrice;
            const changeText = document.getElementById('changeText');
            const changeBox = document.getElementById('changeBox');
            const changeLabel = document.getElementById('changeLabel');
            
            if (cashRaw === '' || cash === 0) {
                changeLabel.innerText = 'Uang Kembalian:';
                changeText.innerText = 'Rp 0';
                changeText.className = 'text-sm font-extrabold text-slate-800';
                changeBox.className = 'p-3 rounded-xl border border-dashed border-gray-200 bg-slate-50 flex items-center justify-between transition-colors';
            } else if (change >= 0) {
                changeLabel.innerText = 'Kembalian:';
                changeText.innerText = formatRupiah(change);
                changeText.className = 'text-sm font-extrabold text-emerald-700';
                changeBox.className = 'p-3 rounded-xl border border-emerald-300 bg-emerald-50/70 flex items-center justify-between transition-colors';
            } else {
                changeLabel.innerText = 'Kurang:';
                changeText.innerText = formatRupiah(Math.abs(change));
                changeText.className = 'text-sm font-extrabold text-rose-600';
                changeBox.className = 'p-3 rounded-xl border border-rose-300 bg-rose-50/70 flex items-center justify-between transition-colors';
            }
        }

        function setUangPas() {
            if (totalPrice > 0) {
                document.getElementById('cashAmount').value = totalPrice;
                calculateChange();
            }
        }

        function setCash(amount) {
            document.getElementById('cashAmount').value = amount;
            calculateChange();
        }

        function processPayment() {
            if (!cart || cart.length === 0) {
                alert('Keranjang belanja kosong!');
                return;
            }

            const cashRaw = document.getElementById('cashAmount').value.trim();
            const cashInput = parseFloat(cashRaw) || 0;

            if (cashRaw === '' || isNaN(cashInput) || cashInput <= 0) {
                alert('Silakan masukkan jumlah uang yang diterima!');
                document.getElementById('cashAmount').focus();
                return;
            }

            if (cashInput < totalPrice) {
                alert('Nominal uang pembayaran kurang dari total tagihan!');
                document.getElementById('cashAmount').focus();
                return;
            }

            const btnSubmit = document.getElementById('btnSubmit');
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Memproses...</span>';

            // Submit form pembayaran
            document.getElementById('paymentForm').submit();
        }
    </script>
</body>
</html>