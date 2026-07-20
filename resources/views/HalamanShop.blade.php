<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q-CIS SMK - Katalog Produk</title>  
    <script src="https://cdn.tailwindcss.com"></script>   
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen font-sans">
   
    <div class="w-full max-w-md bg-white min-h-screen shadow-lg flex flex-col justify-between relative pb-32">
               
        <div class="px-5 pt-5 pb-3">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold text-emerald-800 tracking-wide">Q-CIS SMK</h1>
                               
                <div class="flex items-center gap-2">                   
                    <button class="relative p-1 text-emerald-800 mr-1">
                        <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                        <span id="badge-cart-top" class="absolute -top-1 -right-1 bg-slate-600 text-[9px] text-white w-4 h-4 rounded-full flex items-center justify-center font-bold">0</span>
                    </button>
                  
                    <button class="relative p-1 text-emerald-800">
                        <i data-lucide="bell" class="w-6 h-6"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-emerald-500 rounded-full"></span>
                    </button>
                  
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop&q=80" alt="Profile" class="w-9 h-9 rounded-full border-2 border-emerald-100 object-cover">
                </div>
            </div>
          
            <div class="relative mb-4">
                <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                <input type="text" placeholder="Cari produk di mart..." class="w-full bg-blue-50 text-gray-700 pl-11 pr-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600/20">
            </div>
           
            <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1 text-sm font-medium" id="category-filters">
                <button onclick="filterProduk('all', this)" class="category-btn bg-emerald-800 text-white px-5 py-1.5 rounded-full whitespace-nowrap">Semua</button>
                <button onclick="filterProduk('Minuman', this)" class="category-btn bg-blue-50 text-slate-600 px-5 py-1.5 rounded-full whitespace-nowrap">Minuman</button>
                <button onclick="filterProduk('Makanan Ringan', this)" class="category-btn bg-blue-50 text-slate-600 px-5 py-1.5 rounded-full whitespace-nowrap">Makanan Ringan</button>
                <button onclick="filterProduk('Alat Tulis', this)" class="category-btn bg-blue-50 text-slate-600 px-5 py-1.5 rounded-full whitespace-nowrap">Alat Tulis</button>
            </div>
        </div>

        <hr class="border-gray-100">
       
        <div class="px-5 py-4 flex-1 mb-20">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-slate-800">Katalog Produk</h2>
                <span class="text-xs font-semibold text-slate-500"><b class="text-emerald-700">{{ count($products) }}</b> Produk</span>
            </div>       
            <div class="grid grid-cols-2 gap-4" id="product-grid">
                @foreach($products as $item)           
                <div data-category="{{ $item['kategori'] ?? 'semua' }}" class="product-card bg-white border border-gray-100 rounded-2xl p-3 shadow-sm flex flex-col justify-between relative">
                    <span class="absolute top-3 right-3 {{ $item['warna_badge'] }} text-[9px] font-bold text-white px-2 py-0.5 rounded-md">
                        {{ $item['badge'] }}
                    </span>
                    <div class="bg-gray-50 rounded-xl p-2 flex justify-center items-center mb-3 h-32">
                        <img src="{{ $item['img'] }}" alt="{{ $item['nama'] }}" class="h-24 object-contain">
                    </div>
                    <div>
                        <h3 class="font-bold text-sm text-slate-800 line-clamp-1">{{ $item['nama'] }}</h3>
                        <p class="text-[10px] text-gray-400 mb-2">Stok: {{ $item['stok'] }}</p>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-emerald-700 text-sm">Rp {{ number_format($item['harga'], 0, ',', '.') }}</span>
                            <button 
                                onclick="tambahKeKeranjang({{ $item['harga'] }})"
                                class="bg-emerald-800 text-white p-1.5 rounded-lg hover:bg-emerald-700 transition"
                            >
                                <i data-lucide="plus" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
       
        <div class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-100 shadow-2xl z-50 rounded-t-2xl">
                  
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
                <button class="bg-emerald-800 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-1">
                    Checkout <i data-lucide="chevron-up" class="w-4 h-4"></i>
                </button>
            </div>
          
            <div class="grid grid-cols-4 pt-3 pb-4 text-center text-xs font-semibold text-gray-400">
                <a href="{{ url('/HalamanDepanKasir') }}" class="flex flex-col items-center justify-center text-gray-500 hover:text-gray-800 text-[11px] font-medium gap-1">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span>Home</span>
                </a>
                
                <a href="{{ url('/HalamanShop') }}" class="flex flex-col items-center justify-center bg-[#84FF95] text-[#006A33] mx-2 py-1.5 rounded-xl font-bold text-xs gap-0.5">
                    <i data-lucide="shopping-bag" class="w-5 h-5 stroke-[2.5]"></i>
                    <span>Shop</span>
                </a>
                
                <a href="#" class="flex flex-col items-center justify-center text-gray-500 hover:text-gray-800 text-[11px] font-medium gap-1">
                    <i data-lucide="file-text" class="w-5 h-5"></i>
                    <span>Trans</span>
                </a>
                
                <a href="#" class="flex flex-col items-center justify-center text-gray-500 hover:text-gray-800 text-[11px] font-medium gap-1">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    <span>Profile</span>
                </a>
            </div>
        </div>

    </div>   

    <script>
    lucide.createIcons();
   
    let totalItem = 0;
    let totalBayar = 0;
   
    function tambahKeKeranjang(harga) {
        totalItem += 1;
        totalBayar += harga;
       
        document.getElementById('badge-cart').innerText = totalItem;
               
        if (document.getElementById('badge-cart-top')) {
            document.getElementById('badge-cart-top').innerText = totalItem;
        }
               
        document.getElementById('total-harga').innerText = 'Rp ' + totalBayar.toLocaleString('id-ID');
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
</script>
</body>
</html>