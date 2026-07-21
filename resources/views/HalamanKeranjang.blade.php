<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">

    <div class="fixed inset-0 bg-slate-900/30 backdrop-blur-sm flex items-end sm:items-center justify-center p-0 sm:p-4 z-50">
        
        <div class="w-full max-w-md bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl overflow-hidden transform transition-all">
            
            <div class="flex justify-center pt-3 pb-1">
                <div class="w-12 h-1 bg-gray-300 rounded-full"></div>
            </div>

            <div class="px-6 py-3 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900">Keranjang Belanja</h2>
                
                <button type="button" onclick="history.back()" class="text-gray-400 hover:text-gray-600 transition-colors text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div id="cart-list" class="px-6 py-2 space-y-3 max-h-[50vh] overflow-y-auto">
            </div>

            <div class="mt-4 p-6 bg-slate-50/80 border-t border-slate-100 rounded-b-3xl">
                <div class="space-y-2 pb-3 text-sm">
                    <div class="flex justify-between text-gray-600 font-medium">
                        <span>Subtotal</span>
                        <span id="subtotal" class="font-bold text-gray-800">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-gray-600 font-medium">
                        <span>Diskon Pelajar</span>
                        <span id="discount" class="font-bold text-emerald-600">Rp 0</span>
                    </div>
                </div>

                <div class="pt-3 border-t border-gray-200/60 flex justify-between items-center mb-5">
                    <span class="text-lg font-extrabold text-gray-900">Total Tagihan</span>
                    <span id="total-tagihan" class="text-xl font-black text-emerald-700">Rp 0</span>
                </div>

                <a href="{{ url('/halamanpembayaran') }}" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white font-bold py-3.5 px-4 rounded-xl shadow-md shadow-emerald-900/20 flex items-center justify-center space-x-2 transition-all active:scale-[0.98]">
                    <span>Bayar Sekarang</span>
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>
            </div>

        </div>
    </div>

    <script>
    let cart = JSON.parse(localStorage.getItem('cartItems')) || [];
    const discountValue = 8000; // Diskon Rp 8.000

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    function renderCart() {
        const container = document.getElementById('cart-list');
        let subtotal = 0;

        if (!container || cart.length === 0) {
            if (container) {
                container.innerHTML = `
                    <div class="text-center py-10 text-gray-400">
                        <i class="fa-solid fa-basket-shopping text-3xl mb-2"></i>
                        <p class="font-semibold text-sm">Keranjang kamu masih kosong</p>
                    </div>
                `;
            }
            updateSummary(0);
            return;
        }

        let html = '';
        cart.forEach((item, index) => {
            let itemTotal = item.harga * item.qty;
            subtotal += itemTotal;

            html += `
                <div class="flex items-center justify-between p-3 bg-white border border-gray-100 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-3">
                        <img src="${item.img}" alt="${item.nama}" class="w-12 h-12 object-contain rounded-xl border border-gray-50">
                        <div>
                            <h4 class="font-bold text-sm text-slate-800 leading-tight">${item.nama}</h4>
                            <p class="text-xs text-emerald-700 font-semibold mt-0.5">${formatRupiah(item.harga)}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="ubahQty(${index}, -1)" class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100 text-xs font-semibold">
                            <i class="fa-solid fa-minus text-[10px]"></i>
                        </button>
                        <span class="text-sm font-bold text-slate-800 w-4 text-center">${item.qty}</span>
                        <button onclick="ubahQty(${index}, 1)" class="w-6 h-6 rounded-full bg-emerald-700 text-white flex items-center justify-center hover:bg-emerald-800 text-xs font-semibold shadow-sm">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                        </button>
                        <button onclick="hapusItem(${index})" class="text-red-400 hover:text-red-600 ml-2 text-sm transition-colors">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            `;
        });

        container.innerHTML = html;
        updateSummary(subtotal);
    }

    function updateSummary(subtotal) {
        const finalDiscount = subtotal > 0 ? discountValue : 0;
        const grandTotal = Math.max(0, subtotal - finalDiscount);

        if (document.getElementById('subtotal')) {
            document.getElementById('subtotal').innerText = formatRupiah(subtotal);
        }
        if (document.getElementById('discount')) {
            document.getElementById('discount').innerText = subtotal > 0 ? '- ' + formatRupiah(finalDiscount) : 'Rp 0';
        }
        if (document.getElementById('total-tagihan')) {
            document.getElementById('total-tagihan').innerText = formatRupiah(grandTotal);
        }
    }

    function ubahQty(index, delta) {
        cart[index].qty += delta;

        if (cart[index].qty <= 0) {
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

    document.addEventListener('DOMContentLoaded', renderCart);
    </script>
</body>
</html>