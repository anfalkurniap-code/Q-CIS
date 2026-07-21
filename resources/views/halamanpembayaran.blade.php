<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pembayaran</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,Helvetica,sans-serif;
}

body{
    background:#f2f2f2;
}

.container{
    width:380px;
    margin:20px auto;
}

.card{
    background:#fff;
    border-radius:8px;
    padding:15px;
    margin-bottom:15px;
    box-shadow:0 1px 5px rgba(0,0,0,.1);
}

.title{
    font-size:11px;
    color:#777;
    font-weight:bold;
    margin-bottom:15px;
    text-transform:uppercase;
}

.right{
    float:right;
    font-weight:normal;
}

.item{
    display:flex;
    align-items:center;
    margin-bottom:18px;
}

.item:last-child{
    margin-bottom:0;
}

.product-img {
    width:45px;
    height:45px;
    border-radius:8px;
    object-fit:cover;
    background:#ececec;
}

.detail{
    flex:1;
    margin-left:12px;
}

.detail h4{
    font-size:14px;
    font-weight:500;
}

.detail p{
    font-size:12px;
    color:#777;
    margin-top:5px;
}

.price{
    font-weight:bold;
    font-size:15px;
    margin-right:12px;
}

.delete{
    color:#ff6b6b;
    cursor:pointer;
}

.payment{
    display:flex;
    gap:10px;
}

.box{
    flex:1;
    height:80px;
    border:1px solid #ddd;
    border-radius:8px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    cursor:pointer;
    transition: all 0.2s ease;
}

.box.active{
    border:2px solid #18b04b;
    background-color: #f6fff9;
}

.box i{
    font-size:24px;
    margin-bottom:8px;
}

/* CSS Tampilan QRIS & Tunai */
.content-section {
    display: none;
}

.content-section.active {
    display: block;
}

.qr{
    width:180px;
    height:180px;
    margin:20px auto;
    border-radius:10px;
    border:1px solid #ddd;
    display:flex;
    justify-content:center;
    align-items:center;
}

.qr i{
    font-size:120px;
}

.info{
    background:#eaf7ef;
    border:1px solid #d6ebdd;
    padding:12px;
    border-radius:8px;
    margin-top:15px;
}

.info h3{
    color:#16a34a;
    font-size:18px;
}

.info p{
    margin-top:5px;
    color:#666;
    font-size:13px;
}

/* Form Tunai CSS */
.input-group {
    margin-bottom: 15px;
}

.input-group label {
    display: block;
    font-size: 13px;
    color: #555;
    margin-bottom: 6px;
    font-weight: bold;
}

.input-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
}

.input-group input:focus {
    border-color: #18b04b;
}

.change-box {
    background: #f8f9fa;
    border: 1px dashed #bbb;
    border-radius: 8px;
    padding: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.change-box span {
    font-size: 14px;
    color: #555;
}

.change-box strong {
    font-size: 18px;
    color: #16a34a;
}

.waiting{
    margin-top:15px;
    background:#ededed;
    border-radius:8px;
    padding:12px;
    display:flex;
    align-items:center;
    gap:10px;
    color:#555;
}

.summary{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
}

.total{
    display:flex;
    justify-content:space-between;
    border-top:1px solid #ddd;
    padding-top:15px;
    margin-top:10px;
}

.total h2{
    color:#16a34a;
}

button{
    width:100%;
    padding:14px;
    margin-top:18px;
    background:#18a84a;
    border:none;
    color:white;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#12853b;
}

.footer{
    text-align:center;
    font-size:10px;
    color:#888;
    margin-top:12px;
}
</style>

</head>
<body>

<div class="container">

    <!-- RINCIAN PESANAN -->
    <div class="card">
        <div class="title">
            RINCIAN PESANAN
            <span class="right">2 Items</span>
        </div>

        <div class="item">
            <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b?w=100&auto=format&fit=crop&q=60" alt="Susu Ultramilk" class="product-img">
            <div class="detail">
                <h4>Susu Ultramilk Strawberry 250ml</h4>
                <p>Kuantitas : 1</p>
            </div>
            <div class="price">Rp 6.000</div>
            <div class="delete"><i class="fa-regular fa-trash-can"></i></div>
        </div>

        <hr style="margin:15px 0;border:1px solid #eee;">

        <div class="item">
            <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?w=100&auto=format&fit=crop&q=60" alt="Roti Tawar" class="product-img">
            <div class="detail">
                <h4>Roti Tawar Sari Roti</h4>
                <p>Kuantitas : 1</p>
            </div>
            <div class="price">Rp 6.500</div>
            <div class="delete"><i class="fa-regular fa-trash-can"></i></div>
        </div>
    </div>

    <!-- METODE PEMBAYARAN -->
    <div class="card">
        <div class="title">METODE PEMBAYARAN</div>
        <div class="payment">
            <div class="box active" id="btnQris" onclick="switchPayment('qris')">
                <i class="fa-solid fa-qrcode" style="color:#17a34a;"></i>
                QRIS
            </div>
            <div class="box" id="btnCash" onclick="switchPayment('cash')">
                <i class="fa-solid fa-wallet" style="color:#ff8b2d;"></i>
                Tunai
            </div>
        </div>
    </div>

    <!-- INSTRUKSI / INPUT PEMBAYARAN -->
    <div class="card">
        <h3 style="margin-bottom:15px;">Instruksi Pembayaran</h3>

        <!-- Tampilan QRIS -->
        <div id="sectionQris" class="content-section active">
            <div class="qr">
                <i class="fa-solid fa-qrcode"></i>
            </div>
            <div class="info">
                <h3>QRIS Aktif</h3>
                <p>Pindai kode di atas dengan m-banking atau e-wallet (Gopay, OVO, Dana) untuk membayar.</p>
            </div>
            <div class="waiting">
                <i class="fa-solid fa-spinner fa-spin"></i>
                Menunggu pembayaran...
            </div>
        </div>

        <!-- Tampilan TUNAI -->
        <div id="sectionCash" class="content-section">
            <div class="input-group">
                <label for="cashAmount">Jumlah Uang Diterima (Rp):</label>
                <input type="number" id="cashAmount" placeholder="Masukkan nominal, misal: 20000" oninput="calculateChange()">
            </div>

            <div class="change-box">
                <span>Uang Kembalian:</span>
                <strong id="changeText">Rp 0</strong>
            </div>
        </div>
    </div>

    <!-- RINGKASAN -->
    <div class="card">
        <div class="title">RINGKASAN</div>
        <div class="summary">
            <span>Subtotal</span>
            <span>Rp 12.500</span>
        </div>
        <div class="summary">
            <span>Pajak (0%)</span>
            <span>Rp 0</span>
        </div>
        <div class="total">
            <strong>Total</strong>
            <h2>Rp 12.500</h2>
        </div>

        <button onclick="processPayment()">
            <i class="fa-solid fa-circle-check"></i>
            Selesaikan Pembayaran
        </button>

        <div class="footer">
            Dengan membayar, Anda menyetujui S&K Q-CIS SMK Mart.
        </div>
    </div>

</div>

<!-- JAVASCRIPT UNTUK INTERAKSI -->
<script>
    const totalPrice = 12500; // Total belanja
    let currentMethod = 'qris';

    function switchPayment(method) {
        currentMethod = method;
        
        // Element Tombol
        const btnQris = document.getElementById('btnQris');
        const btnCash = document.getElementById('btnCash');
        
        // Element Section Tampilan
        const sectionQris = document.getElementById('sectionQris');
        const sectionCash = document.getElementById('sectionCash');

        if (method === 'cash') {
            btnQris.classList.remove('active');
            btnCash.classList.add('active');
            
            sectionQris.classList.remove('active');
            sectionCash.classList.add('active');
        } else {
            btnCash.classList.remove('active');
            btnQris.classList.add('active');
            
            sectionCash.classList.remove('active');
            sectionQris.classList.add('active');
        }
    }

    function calculateChange() {
        const cashInput = document.getElementById('cashAmount').value;
        const changeText = document.getElementById('changeText');
        
        const cash = parseFloat(cashInput) || 0;
        const change = cash - totalPrice;

        if (cash === 0) {
            changeText.innerText = 'Rp 0';
            changeText.style.color = '#16a34a';
        } else if (change >= 0) {
            changeText.innerText = 'Rp ' + change.toLocaleString('id-ID');
            changeText.style.color = '#16a34a'; // Warna Hijau jika uang cukup
        } else {
            changeText.innerText = 'Uang Kurang (Rp ' + Math.abs(change).toLocaleString('id-ID') + ')';
            changeText.style.color = '#ff6b6b'; // Warna Merah jika uang kurang
        }
    }

    function processPayment() {
        if (currentMethod === 'cash') {
            const cashInput = parseFloat(document.getElementById('cashAmount').value) || 0;
            if (cashInput < totalPrice) {
                alert('Nominal uang pembayaran kurang dari total tagihan!');
                return;
            }
            const change = cashInput - totalPrice;
            alert('Pembayaran Tunai Berhasil!\nKembalian: Rp ' + change.toLocaleString('id-ID'));
        } else {
            alert('Memeriksa status pembayaran QRIS...');
        }
    }
</script>

</body>
</html>