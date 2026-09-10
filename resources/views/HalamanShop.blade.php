<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK - Katalog Produk</title>   
    <script src="https://cdn.tailwindcss.com"></script>   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen font-sans">
   
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between relative pb-20">
             
        <!-- ================= TOP HEADER BAR ================= -->
        <div class="px-5 pt-5 pb-3">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-2.5">
                    <h1 class="text-xl font-bold text-emerald-800 tracking-wide">Q-CIS SMK</h1>
                </div>
                            
                <div class="flex items-center gap-3">   
                    <!-- Link Keranjang Top Bar -->
                    <a href="{{ url('/HalamanKeranjang') }}" class="relative p-1 text-emerald-800 flex items-center justify-center cursor-pointer transition-colors hover:text-emerald-600">
                        <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                        <span id="badge-cart-top" class="absolute -top-1.5 -right-2 bg-slate-700 text-[10px] text-white w-5 h-5 rounded-full flex items-center justify-center font-bold border-2 border-white shadow-sm">0</span>
                    </a>
                 
                    <!-- Foto Profil Header -->
                    <a href="{{ url('/HalamanProfile') }}" class="block relative transition-transform active:scale-95" title="Ke Halaman Profil">
                        <img id="header-avatar" 
                             src="{{ $user->avatar_url ?? 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&q=80&w=300' }}" 
                             alt="Profile" 
                             class="w-9 h-9 rounded-full object-cover ring-2 ring-emerald-300 ring-offset-1 border border-transparent shadow-sm">
                    </a>
                </div>
            </div>
          
            <!-- Input Search Produk -->
            <div class="relative mb-4">
                <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari produk di mart..." class="w-full bg-blue-50 text-gray-700 pl-11 pr-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20">
            </div>
           
            <!-- Filter Kategori -->
            <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1 text-sm font-medium" id="category-filters">
                <button onclick="filterProduk('all', this)" class="category-btn bg-emerald-800 text-white px-5 py-1.5 rounded-full whitespace-nowrap">Semua</button>
                @foreach($categories ?? [] as $cat)
                    <button onclick="filterProduk('{{ $cat->name }}', this)" class="category-btn bg-blue-50 text-slate-600 px-5 py-1.5 rounded-full whitespace-nowrap">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <hr class="border-gray-100">
       
        <!-- ================= KATALOG PRODUK ================= -->
        <div class="px-5 py-4 flex-1">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-slate-800">Katalog Produk</h2>
                <span class="text-xs font-semibold text-slate-500"><b class="text-emerald-700">{{ count($products) }}</b> Produk</span>
            </div>      
            
            <div class="grid grid-cols-2 gap-4" id="product-grid">
                
                {{-- PERULANGAN DATA PRODUK DARI DATABASE --}}
                @foreach($products as $item)         
                <div data-category="{{ $item->kategori ?? 'semua' }}" class="product-card bg-white border border-gray-100 rounded-2xl p-3 shadow-sm flex flex-col justify-between relative">
                    
                    @if(!empty($item->badge))
                    <span class="absolute top-3 right-3 {{ $item->warna_badge ?? 'bg-emerald-600' }} text-[9px] font-bold text-white px-2 py-0.5 rounded-md">
                        {{ $item->badge }}
                    </span>
                    @endif

                    <div class="bg-gray-50 rounded-xl p-2 flex justify-center items-center mb-3 h-32 overflow-hidden">
                        @if(!empty($item->image))
                            <img src="{{ Storage::url($item->image) }}" 
                                 alt="{{ $item->name ?? 'Produk' }}" 
                                 class="h-28 max-w-full object-cover rounded-lg">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div>
                        <h3 class="font-bold text-sm text-slate-800 line-clamp-1" title="{{ $item->name }}">
                            {{ $item->name ?? 'Tanpa Nama' }}
                        </h3>

                        <!-- Warna merah jika stok habis -->
                        <p class="text-[10px] {{ ($item->stock ?? 0) <= 0 ? 'text-red-500 font-bold' : 'text-gray-400' }} mb-2">
                            Stok: {{ $item->stock ?? 0 }}
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="font-bold text-emerald-700 text-sm">
                                Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}
                            </span>
                            
                            <!-- CEK STOK DATABASE DENGAN IF-ELSE -->
                            @if(($item->stock ?? 0) > 0)
                            <button 
                                onclick="tambahKeKeranjang(
                                    {{ $item->id }}, 
                                    '{{ addslashes($item->name) }}', 
                                    {{ $item->price }}, 
                                    '{{ $item->img }}',
                                    {{ $item->stock }}
                                )"
                                class="bg-emerald-800 text-white p-1.5 rounded-lg hover:bg-emerald-700 transition cursor-pointer active:scale-95"
                                title="Tambah ke keranjang"
                            >
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </button>
                            @else
                            <button disabled class="bg-gray-200 text-gray-400 px-2 py-1 rounded-lg text-[10px] font-bold cursor-not-allowed">
                                Habis
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-2 text-center py-12 text-slate-400">
                    <i data-lucide="package-open" class="w-10 h-10 mx-auto mb-2 text-slate-300"></i>
                    <p class="text-xs font-semibold">Belum ada produk yang tersedia di katalog</p>
                </div>
                @endforelse

            </div>
        </div>
       
        <!-- ================= BOTTOM BAR & NAVIGATION ================= -->
        <div class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t border-gray-100 shadow-2xl z-50 rounded-t-2xl">
                
            <!-- Total Harga & Tombol Checkout -->
            <div class="bg-blue-50/70 px-5 py-3 flex justify-between items-center border-b border-gray-100 rounded-t-2xl">
                <div class="flex items-center gap-3">
                    <div class="relative bg-white p-2 rounded-xl shadow-sm border border-gray-100">
                        <i data-lucide="shopping-cart" class="w-5 h-5 text-emerald-800"></i>                     
                        <span id="badge-cart" class="absolute -top-1.5 -right-1.5 bg-slate-600 text-[10px] text-white w-4 h-4 rounded-full flex items-center justify-center font-bold">0</span>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 font-bold tracking-wider">TOTAL</p>                     
                        <p id="total-harga" class="font-bold text-emerald-800 text-lg">Rp 0</p>
                    </div>
                </div>
                <a href="{{ url('/HalamanKeranjang') }}" class="bg-emerald-800 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-1 cursor-pointer relative z-10">
                    Checkout <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            </div>
         
            <!-- Bottom Navigation Bar -->
            <div class="bg-white border-t border-slate-100 px-6 py-2.5 flex justify-between items-center">

              <a href="{{ url('/HalamanDepanKasir') }}" class="flex flex-col items-center {{ Request::is('HalamanDepanKasir*') ? 'text-emerald-600' : 'text-slate-400' }} gap-1 hover:text-emerald-600">
                <i class="fa-solid fa-house text-lg"></i>
                <span class="text-[10px] font-semibold">Home</span>
              </a>

              <a href="{{ url('/HalamanShop') }}" class="flex flex-col items-center {{ Request::is('HalamanShop*') ? 'text-emerald-600' : 'text-slate-400' }} gap-1 hover:text-emerald-600">
                <i class="fa-solid fa-bag-shopping text-lg"></i>
                <span class="text-[10px] font-semibold">Shop</span>
              </a>

              <a href="{{ url('/Riwayattransaksi') }}" class="flex flex-col items-center {{ Request::is('Riwayattransaksi*') ? 'text-emerald-600' : 'text-slate-400' }} gap-1 hover:text-emerald-600">
                <i class="fa-solid fa-receipt text-lg"></i>
                <span class="text-[10px] font-semibold">Trans</span>
              </a>

              <a href="{{ url('/HalamanProfile') }}" class="flex flex-col items-center {{ Request::is('HalamanProfile*') ? 'text-emerald-600' : 'text-slate-400' }} gap-0.5">
                <div class="{{ Request::is('HalamanProfile*') ? 'bg-emerald-600 text-white px-4 py-1.5 rounded-xl flex items-center justify-center shadow-sm' : 'flex items-center justify-center' }}">
                  <i class="fa-solid fa-user {{ Request::is('HalamanProfile*') ? 'text-sm' : 'text-lg' }}"></i>
                </div>
                <span class="text-[10px] {{ Request::is('HalamanProfile*') ? 'font-bold text-emerald-600' : 'font-semibold text-slate-400' }}">Profile</span>
              </a>

            </div>
        </div>

    </div>   

    <script>
        lucide.createIcons();

        function updateCartUI() {
            let cart = JSON.parse(localStorage.getItem('cartItems')) || [];

            let totalItem = cart.reduce((sum, item) => sum + item.qty, 0);
            let totalBayar = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);

            const badgeCart = document.getElementById('badge-cart');
            if (badgeCart) badgeCart.innerText = totalItem;

            const badgeCartTop = document.getElementById('badge-cart-top');
            if (badgeCartTop) badgeCartTop.innerText = totalItem;

            const totalHarga = document.getElementById('total-harga');
            if (totalHarga) totalHarga.innerText = 'Rp ' + totalBayar.toLocaleString('id-ID');
        }

        // FUNGSI TAMBAH KE KERANJANG DENGAN PEMBATASAN STOK
        function tambahKeKeranjang(id, nama, harga, img, stok) {
            let cart = JSON.parse(localStorage.getItem('cartItems')) || [];
            let itemIndex = cart.findIndex(item => item.id == id);

            let currentQtyInCart = itemIndex > -1 ? cart[itemIndex].qty : 0;

            // Cek batas stok
            if (stok !== undefined && currentQtyInCart >= stok) {
                alert(`Maaf, stok ${nama} hanya tersisa ${stok} item!`);
                return;
            }

            if (itemIndex > -1) {
                cart[itemIndex].qty += 1;
                cart[itemIndex].stok = stok; 
            } else {
                cart.push({
                    id: id,
                    nama: nama,
                    harga: harga,
                    img: img,
                    stok: stok,
                    qty: 1
                });
            }

            localStorage.setItem('cartItems', JSON.stringify(cart));
            updateCartUI();
        }
        
        function filterProduk(kategori, element) {         
            const cards = document.querySelectorAll('.product-card');
            const targetKategori = kategori.toLowerCase().trim();
            
            cards.forEach(card => {
                const cardCategory = (card.getAttribute('data-category') || '').toLowerCase().trim();
                    
                if (targetKategori === 'all' || targetKategori === 'semua' || cardCategory === targetKategori) {
                    card.style.setProperty('display', 'flex', 'important');
                } else {
                    card.style.setProperty('display', 'none', 'important');
                }
            });
             
            const buttons = document.querySelectorAll('#category-filters button');
            buttons.forEach(btn => {
                btn.className = "category-btn bg-blue-50 text-slate-600 px-5 py-1.5 rounded-full whitespace-nowrap";
            });
            
            element.className = "category-btn bg-emerald-800 text-white px-5 py-1.5 rounded-full whitespace-nowrap";
        }

        const searchInput = document.querySelector('input[placeholder="Cari produk di mart..."]');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const keyword = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('.product-card');

                cards.forEach(card => {
                    const productName = card.querySelector('h3').innerText.toLowerCase();
                    if (productName.includes(keyword)) {
                        card.style.setProperty('display', 'flex', 'important');
                    } else {
                        card.style.setProperty('display', 'none', 'important');
                    }
                });
            });
        }

        document.addEventListener('DOMContentLoaded', updateCartUI);
        window.addEventListener('pageshow', updateCartUI);
        window.addEventListener('focus', updateCartUI);
    </script>
</body>
</html>