<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:Arial,Helvetica,sans-serif;}
        body{background:#f2f2f2;}
        .container{width:380px;margin:20px auto;}
        
        /* Tombol Kembali Style */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #555;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 12px;
            padding: 8px 12px;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
            transition: all 0.2s ease;
        }
        .btn-back:hover {
            color: #18a84a;
            background: #f8f9fa;
        }

        .card{background:#fff;border-radius:8px;padding:15px;margin-bottom:15px;box-shadow:0 1px 5px rgba(0,0,0,.1);}
        .title{font-size:11px;color:#777;font-weight:bold;margin-bottom:15px;text-transform:uppercase;}
        .right{float:right;font-weight:normal;}
        .item{display:flex;align-items:center;margin-bottom:18px;}
        .item:last-child{margin-bottom:0;}
        .product-img {width:45px;height:45px;border-radius:8px;object-fit:cover;background:#ececec;}
        .detail{flex:1;margin-left:12px;}
        .detail h4{font-size:14px;font-weight:500;}
        .detail p{font-size:12px;color:#777;margin-top:5px;}
        .price{font-weight:bold;font-size:15px;margin-right:12px;}
        .payment{display:flex;gap:10px;}
        .box{flex:1;height:80px;border:1px solid #ddd;border-radius:8px;display:flex;flex-direction:column;justify-content:center;align-items:center;cursor:pointer;transition: all 0.2s ease;}
        .box.active{border:2px solid #18b04b;background-color: #f6fff9;}
        .box i{font-size:24px;margin-bottom:8px;}
        .content-section {display: none;}
        .content-section.active {display: block;}
        .qr{width:180px;height:180px;margin:20px auto;border-radius:10px;border:1px solid #ddd;display:flex;justify-content:center;align-items:center;}
        .qr i{font-size:120px;}
        .info{background:#eaf7ef;border:1px solid #d6ebdd;padding:12px;border-radius:8px;margin-top:15px;}
        .info h3{color:#16a34a;font-size:18px;}
        .info p{margin-top:5px;color:#666;font-size:13px;}
        .input-group {margin-bottom: 15px;}
        .input-group label {display: block;font-size: 13px;color: #555;margin-bottom: 6px;font-weight: bold;}
        .input-group input {width: 100%;padding: 12px;border: 1px solid #ccc;border-radius: 6px;font-size: 16px;outline: none;}
        .input-group input:focus {border-color: #18b04b;}
        .change-box {background: #f8f9fa;border: 1px dashed #bbb;border-radius: 8px;padding: 12px;display: flex;justify-content: space-between;align-items: center;}
        .change-box span {font-size: 14px;color: #555;}
        .change-box strong {font-size: 18px;color: #16a34a;}
        .summary{display:flex;justify-content:space-between;margin-bottom:10px;}
        .total{display:flex;justify-content:space-between;border-top:1px solid #ddd;padding-top:15px;margin-top:10px;}
        .total h2{color:#16a34a;}
        button.btn-submit{width:100%;padding:14px;margin-top:18px;background:#18a84a;border:none;color:white;border-radius:8px;font-size:16px;cursor:pointer;}
        button.btn-submit:hover{background:#12853b;}
    </style>
</head>
<body>

<form id="paymentForm" action="{{ route('pembayaran.proses') }}" method="POST">
    @csrf
    <!-- Input hidden untuk mengirim data ke Backend Laravel -->
    <input type="hidden" name="cart_data" id="cartDataInput">
    <input type="hidden" name="payment_method" id="paymentMethodInput" value="qris">
    <input type="hidden" name="total_price" id="totalPriceInput" value="0">

    <div class="container">

        <!-- TOMBOL KEMBALI -->
        <a href="javascript:history.back()" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <div class="title">RINCIAN PESANAN<span class="right" id="totalItemsText">0 Items</span></div>
            
            <!-- Tempat daftar barang akan di-render dinamis -->
            <div id="cartItemsContainer"></div>
        </div>

        <div class="card">
            <div class="title">METODE PEMBAYARAN</div>
            <div class="payment">
                <div class="box active" id="btnQris" onclick="switchPayment('qris')">
                    <i class="fa-solid fa-qrcode" style="color:#17a34a;"></i> QRIS
                </div>
                <div class="box" id="btnCash" onclick="switchPayment('cash')">
                    <i class="fa-solid fa-wallet" style="color:#ff8b2d;"></i> Tunai
                </div>
            </div>
        </div>

        <div class="card">
            <h3 style="margin-bottom:15px;">Instruksi Pembayaran</h3>
            <div id="sectionQris" class="content-section active">
                <div class="qr"><i class="fa-solid fa-qrcode"></i></div>
                <div class="info">
                    <h3>QRIS Aktif</h3>
                    <p>Pindai kode di atas dengan m-banking atau e-wallet untuk membayar.</p>
                </div>
            </div>
            <div id="sectionCash" class="content-section">
                <div class="input-group">
                    <label for="cashAmount">Jumlah Uang Diterima (Rp):</label>
                    <input type="number" id="cashAmount" name="cash_amount" placeholder="Masukkan nominal, misal: 20000" oninput="calculateChange()">
                </div>
                <div class="change-box">
                    <span>Uang Kembalian:</span>
                    <strong id="changeText">Rp 0</strong>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="title">RINGKASAN</div>
            <div class="summary"><span>Subtotal</span><span id="subtotalText">Rp 0</span></div>
            <div class="total"><strong>Total</strong><h2 id="totalText">Rp 0</h2></div>
            <button type="button" class="btn-submit" onclick="processPayment()">
                <i class="fa-solid fa-circle-check"></i> Selesaikan Pembayaran
            </button>
        </div>
    </div>
</form>

<script>
    let totalPrice = 0;
    let currentMethod = 'qris';
    let cart = [];

    // 1. Memuat keranjang belanja dari LocalStorage saat halaman pertama kali dibuka
    document.addEventListener('DOMContentLoaded', function() {
        const storedCart = localStorage.getItem('qcis_cart');
        if (storedCart) {
            cart = JSON.parse(storedCart);
        }
        renderCart();
    });

    // 2. Fungsi untuk menampilkan item barang dan menghitung total harga
    function renderCart() {
        const container = document.getElementById('cartItemsContainer');
        container.innerHTML = '';
        totalPrice = 0;
        let totalCount = 0;

        if (cart.length === 0) {
            container.innerHTML = '<p style="text-align:center; color:#888;">Keranjang kamu kosong.</p>';
        } else {
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                totalPrice += itemTotal;
                totalCount += item.quantity;

                const itemHTML = `
                    <div class="item">
                        <img src="${item.image || 'https://via.placeholder.com/45'}" alt="${item.name}" class="product-img">
                        <div class="detail">
                            <h4>${item.name}</h4>
                            <p>Kuantitas : ${item.quantity}</p>
                        </div>
                        <div class="price">Rp ${itemTotal.toLocaleString('id-ID')}</div>
                    </div>
                    ${index < cart.length - 1 ? '<hr style="margin:15px 0;border:1px solid #eee;">' : ''}
                `;
                container.innerHTML += itemHTML;
            });
        }

        // Update tampilan harga & ringkasan
        document.getElementById('totalItemsText').innerText = `${totalCount} Items`;
        document.getElementById('subtotalText').innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        document.getElementById('totalText').innerText = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        
        // Simpan nilai total harga ke input hidden
        document.getElementById('totalPriceInput').value = totalPrice;
        document.getElementById('cartDataInput').value = JSON.stringify(cart);
    }

    // 3. Fungsi Ganti Metode Pembayaran
    function switchPayment(method) {
        currentMethod = method;
        document.getElementById('paymentMethodInput').value = method;
        document.getElementById('btnQris').classList.toggle('active', method === 'qris');
        document.getElementById('btnCash').classList.toggle('active', method === 'cash');
        document.getElementById('sectionQris').classList.toggle('active', method === 'qris');
        document.getElementById('sectionCash').classList.toggle('active', method === 'cash');
    }

    // 4. Hitung Kembalian
    function calculateChange() {
        const cash = parseFloat(document.getElementById('cashAmount').value) || 0;
        const change = cash - totalPrice;
        const changeText = document.getElementById('changeText');
        
        if (change >= 0) {
            changeText.innerText = 'Rp ' + change.toLocaleString('id-ID');
            changeText.style.color = '#16a34a';
        } else {
            changeText.innerText = 'Uang Kurang (Rp ' + Math.abs(change).toLocaleString('id-ID') + ')';
            changeText.style.color = '#ff6b6b';
        }
    }

    // 5. Eksekusi Pembayaran
    function processPayment() {
        if (cart.length === 0) {
            alert('Keranjang belanja kosong!');
            return;
        }

        if (currentMethod === 'cash') {
            const cashInput = parseFloat(document.getElementById('cashAmount').value) || 0;
            if (cashInput < totalPrice) {
                alert('Nominal uang pembayaran kurang dari total tagihan!');
                return;
            }
        }

        // Hapus penyimpanan keranjang di browser setelah sukses checkout
        localStorage.removeItem('qcis_cart');
        
        // Kirim Form ke Backend Controller
        document.getElementById('paymentForm').submit();
    }
</script>
</body>
</html>